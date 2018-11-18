<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DevsWebDev\DevTube\Download;
use Masih\YoutubeDownloader\YoutubeDownloader;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $QRCodeFilePath = public_path('home-qrcode.png');
        if (!file_exists($QRCodeFilePath))
            \QRCode::url($request->url())->setOutfile(public_path('home-qrcode.png'))->setSize(8)->setMargin(2)->png();
        return view('home');
    }

    public function test(Request $r) {

        $format = "audio";
        config(['devtube.download_path' => storage_path('media/jBQpGiubj0c/' . $format)]);
        $directoryPath = config('devtube.download_path');
//        dd($directoryPath);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
//        $dl = new Download('https://www.youtube.com/watch?v=jBQpGiubj0c', $format);
//        $dl = new Download('https://www.youtube.com/watch?v=1xYZeDReUz4&start_radio=1&list=RD1xYZeDReUz4', $format);
//        $youtube = new YoutubeDownloader('https://www.youtube.com/watch?v=jBQpGiubj0c');
        $youtube = new YoutubeDownloader('https://www.youtube.com/watch?v=1xYZeDReUz4&start_radio=1&list=RD1xYZeDReUz4');

//        dd($youtube);
        $result = $youtube->getInfo();
        dd($result);
//        $dl = dd($dl);
        //Saves the file to specified directory
//        $dl->download();
//        dd($dl);
        // Return as a download
//        response()->download($dl->savedPath);
        return 'done';
    }

}
