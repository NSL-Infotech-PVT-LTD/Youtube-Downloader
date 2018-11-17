<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use DevsWebDev\DevTube\Download;
use Masih\YoutubeDownloader\YoutubeDownloader;

class VideoController extends Controller {

    public $videoFormat = ['mp4'];
    public $audioFormat = ['audio/mp4', 'audio/webm'];
    public $videoResolution = ['1080p', '720p', '360p', '240p'];
    private $cardLimit = '8';
    public $resolution = ['mp4' => '640 x 360', '3gp' => '320 x 180', '3gpp' => '176 x 144','webm'=>'640 x 360'];
    public $quality = ['mp4' => '360p', '3gp' => '180p', '3gpp' => '144p','webm'=>'360p'];

    public function VideoSearch(Request $request) {
        try {
            $youtube = new YoutubeDownloader($request->search);
            $videoInfo = $youtube->getInfo(true);
            
//            echo intval($videoInfo->adaptive_formats['7']->audio_sample_rate);
//            dd($videoInfo->adaptive_formats['7']);
            if ($videoInfo->response_type === 'video'):
                $videoFormat = $this->videoFormat;
                $videoResolution = $this->videoResolution;
                $audioFormat = $this->audioFormat;
                $resolution = $this->resolution;
                $quality = $this->quality;
                \QRCode::url($request->url() . '?search=' . $videoInfo->video_id)->setOutfile(public_path('qrcodes/' . $videoInfo->video_id . '.png'))->setSize(8)->setMargin(2)->png();
                return view('video.detail', compact('videoInfo', 'request', 'videoFormat', 'videoResolution', 'audioFormat', 'quality', 'resolution'));
            else:
                $page = ['offset' => '0', 'limit' => $this->cardLimit];
                return view('video.playlist', compact('videoInfo', 'request', 'page'));
            endif;
        } catch (\Exception $ex) {
//            dd($ex->getMessage());
            return view('video.nodatafound', compact('request'));
        }
    }

    public function videoPlaylistBYCard(Request $request) {
        try {
            if ($request->ajax()) {
                $youtube = new YoutubeDownloader($request->search . '&list=' . $request->list);
                $videoInfo = $youtube->getInfo();
                $page = ['offset' => $request->offset, 'limit' => $this->cardLimit];
                $view = view('video.playlist.card', compact('videoInfo', 'request', 'page'))->render();
                return response()->json(['html' => $view]);
            }
            return view('home');
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function checksubtitle() {
        $textonly = false;
        $url = 'https://www.youtube.com/api/timedtext?signature=7594AC828B50CC663C81B536C6B0F2896A0109B4.81B0BEBB3E6D806DE59A9FDC00B68008DF95730A&caps=asr&hl=en&sparams=asr_langs%2Ccaps%2Cv%2Cxoaf%2Cxorp%2Cexpire&key=yttt1&expire=1542213583&v=0-YrRDlV0Gg&asr_langs=de%2Cko%2Cru%2Cen%2Cja%2Cnl%2Cpt%2Ces%2Cit%2Cfr&xoaf=1&xorp=True&lang=en&fmt=ttml';
        return $this->convert($url, $textonly);
    }

    public function subtitleDownload(Request $request) {
        $textonly = ($request->textonly == "true") ? false : true;
        return $this->convert($request->url, $textonly);
    }

    //test functions


    private function convert($url, $textonly = false) {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        $cont = curl_exec($curl_handle);
        curl_close($curl_handle);
        if (empty($cont)) {
            exit("Nothing returned from url.<p>");
        }
// Replace <br/>'s
        $cont = str_replace(['<br/>', '<br />'], "\n", $cont);
//         dd($cont);
        $xml = simplexml_load_string($cont);

        //  dd($xml);

        $subs = $xml->body->div->p;
        $num = 1;
        foreach ($subs as $i => $sub) {
            $attrs = $sub->attributes();
            $begin = $attrs['begin'];
            $dur = $attrs['dur'];
            // Do we have spans within? Typically for adding bold/italic text.
            if ($sub->count() > 0) {
                $text = $sub->asXML();
                foreach ($sub->children() as $child) {
                    $child_text = trim($child);
                    $child_attrs = $child->attributes();
                    $child_style = isset($child_attrs['style']) ? $child_attrs['style'] : '';
                    $child_xml = $child->asXML();
                    if ('italic' == $child_style) {
                        $t = "<i>{$child_text}</i>\n";
                    } else if ('bold' == $child_style) {
                        $t = "<b>{$child_text}</b>\n";
                    } else {
                        $t = "{$child_text}\n";
                    }
                    $text = str_replace($child_xml, $t, $text);
                }
                // Only allow <b> and <i> for SRT compatibility. Don't mind <u>.
                $text = strip_tags($text, '<b><i>');
            } else {
                $text = (string) $sub;
            }
            $text = trim($text);
            // remove weird spacings that sometimes come after a newline
            // due to xml formatting and >1 newlines.
            $text = preg_replace([',\n+[ ]+,', ',\n+,'], "\n", $text);
            $timecode = $this->calc_timecode($begin, $dur);
            // Output in Subrip format
            if ($textonly == false) {
                echo "${num}\r\n";
                echo "${timecode}\r\n";
            }
            if ($text != '') {
                echo "${text}\r\n\r\n";
            }
            $num++;
        }
    }

// Subrip time code handling. God damn.
// Written for readability.
// Input: $orig - string with original start time from TTML (HH:MM:SS.XXX)
// Input: $add - string with original due time from TTML, which will be added onto $orig (HH:MM:SS.XXX)
    public function calc_timecode($orig, $add) {
        // Split hours, minutes, seconds and ms
        $orig = preg_split('/[:.,]+/', $orig);
        $add = preg_split('/[:.,]+/', $add);
        // A variable for each unit, for readability
        $o_h = $orig[0];
        $o_m = $orig[1];
        $o_s = $orig[2];
        $o_ms = $orig[3];
        // A variable for each unit, for readability
        $a_h = @$add[0];
        $a_m = @$add[1];
        $a_s = @$add[2];
        $a_ms = @ $add[3];
        // Combine them
        $r_h = is_numeric($o_h) + is_numeric($a_h);
        $r_m = $o_m + $a_m;
        $r_s = $o_s + $a_s;
        $r_ms = $o_ms + $a_ms;
        // MS needs to be lt 1000, add to $r_s if gt 1000.
        if (1000 <= $r_ms) {
            $r_s += floor($r_ms / 1000);
            $r_ms = $r_ms % 1000;
        }
        // S needs to be lt 60, add to $r_m if gt 60.
        if (60 <= $r_s) {
            $r_m += floor($r_s / 60);
            $r_s = $r_s % 60;
        }
        // M needs to be lt 60, add to $r_h if gt 60.
        if (60 <= $r_m) {
            $r_h += floor($r_m / 60);
            $r_m = $r_m % 60;
        }
        $r_h = ($r_h < 10) ? "0" . $r_h : $r_h;
        $r_m = ($r_m < 10) ? "0" . $r_m : $r_m;
        $r_s = ($r_s < 10) ? "0" . $r_s : $r_s;
        $r_ms = (2 == strlen($r_ms)) ? "0" . $r_ms : ((1 == strlen($r_ms)) ? "00" . $r_ms : $r_ms);
        $o = "{$o_h}:{$o_m}:{$o_s},{$o_ms}";
        $r = "{$r_h}:{$r_m}:{$r_s},{$r_ms}";
        return "{$o} --> {$r}";
    }

}
