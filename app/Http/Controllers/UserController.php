<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;

class UserController extends Controller {

    public $gClient;
    private $filename = '';
    private $fileurl = '';

//    public $middleware = ['web'];

    public function __construct(Request $request) {

        $google_redirect_url = route('glogin');
        $this->gClient = new \Google_Client();

        $this->filename = $request->filename;
        $this->fileurl = $request->fileurl;

        $this->gClient->setApplicationName(config('services.google.app_name'));
        $this->gClient->setClientId(config('services.google.client_id'));
        $this->gClient->setClientSecret(config('services.google.client_secret'));
        $this->gClient->setRedirectUri($google_redirect_url);
        $this->gClient->setDeveloperKey(config('services.google.api_key'));
        $this->gClient->setScopes(array(
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive'
        ));
        $this->gClient->setAccessType("offline");
        $this->gClient->setApprovalPrompt("force");
    }

    public function googleLogin(Request $request) {

        if ($this->filename):
            $request->session()->put('filename', $this->filename);
        endif;
        if ($this->fileurl):
            $request->session()->put('fileurl', $this->fileurl);
        endif;
        $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);
        if ($request->get('code')) {
            $this->gClient->authenticate($request->get('code'));
            $request->session()->put('token', $this->gClient->getAccessToken());
        }
        if ($request->session()->get('token')) {
            $this->gClient->setAccessToken($request->session()->get('token'));
        }
        if ($this->gClient->getAccessToken()) {
            $uploadMedia = $this->uploadFileUsingAccessToken($request);
            if ($uploadMedia['status']) {
                return view('share.google', $uploadMedia);
            } else {
                return view('share.google', $uploadMedia);
            }
        } else {
            //For Guest user, get google login url
            echo 'Uploading data to Google drive';
            $authUrl = $this->gClient->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }

    public function uploadFileUsingAccessToken(Request $request) {

        $staus = true;
        try {
            $service = new \Google_Service_Drive($this->gClient);
            $userToken = $request->session()->get('token');
            $this->gClient->setAccessToken($userToken);
            if ($this->gClient->isAccessTokenExpired()) {
                // save refresh token to some variable
                $refreshTokenSaved = $this->gClient->getRefreshToken();
                // update access token
                $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);
                // // pass access token to some variable
                $updatedAccessToken = $this->gClient->getAccessToken();
                // // append refresh token
                $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
                //Set the new acces token
                $this->gClient->setAccessToken($updatedAccessToken);
                $request->session()->put('token', $updatedAccessToken);
            }
            $fileMetadata = new \Google_Service_Drive_DriveFile(array('name' => 'Video', 'mimeType' => 'application/vnd.google-apps.folder'));
            $folder = $service->files->create($fileMetadata, array('fields' => 'id'));
//        printf("Folder ID: %s\n", $folder->id);

            $file = new \Google_Service_Drive_DriveFile(['name' => $request->session()->get('filename'), 'parents' => array($folder->id)]);
            $result = $service->files->create($file, ['data' => file_get_contents($request->session()->get('fileurl')), 'mimeType' => 'application/octet-stream', 'uploadType' => 'media']);
            // get url of uploaded file

            $url = 'https://drive.google.com/open?id=' . $result->id;
            \Session::forget('filename');
            \Session::forget('fileurl');

            return ['url' => $url, 'status' => true];
        } catch (\Exception $ex) {
            $staus = false;
            \Session::forget('filename');
            \Session::forget('fileurl');
            dd($ex->getMessage());
            return ['status' => false, 'message' => $ex->getMessage()];
        }
    }

    public function contactUS(Request $request) {

        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'g-recaptcha-response' => 'required',
                'message' => 'required|min:10|max:100',
            ];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray());
            } else {
                $to_name = 'Support';
                $to_email = 'gauravsethi376@gmail.com';
                $data = ['name' => $request->name, "email" => $request->email, 'support_msg' => $request->message];
                \Mail::send(['html' => 'emails.contactus'], $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('Support Y2D2.com');
                    $message->from('info@y2d2.com', 'Y2D2');
                });
                return redirect()->back()->with(['message' => 'Thanks for contacting support']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors([$ex->getMessage()]);
        }
    }

}
