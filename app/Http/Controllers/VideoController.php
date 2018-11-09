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

    public function VideoSearch(Request $request) {
        try {

            $youtube = new YoutubeDownloader($request->search);
            $videoInfo = $youtube->getInfo();
            if ($videoInfo->response_type === 'video'):
                $videoFormat = $this->videoFormat;
                $videoResolution = $this->videoResolution;
                $audioFormat = $this->audioFormat;
                \QRCode::url($request->url() . '?search=' . $videoInfo->video_id)->setOutfile(public_path('qrcodes/' . $videoInfo->video_id . '.png'))->setSize(8)->setMargin(2)->png();
                return view('video.detail', compact('videoInfo', 'request', 'videoFormat', 'videoResolution', 'audioFormat'));
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

}
