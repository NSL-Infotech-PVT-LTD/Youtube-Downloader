<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $request->session()->put('filename', $this->filename);
        $request->session()->put('fileurl', $this->fileurl);

//            dd($this);
        $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);
        if ($request->get('code')) {
            $this->gClient->authenticate($request->get('code'));
            $request->session()->put('token', $this->gClient->getAccessToken());
        }
        if ($request->session()->get('token')) {
            $this->gClient->setAccessToken($request->session()->get('token'));
        }
        if ($this->gClient->getAccessToken()) {
            //For logged in user, get details from google using acces
//            $user = User::find(1);
//            $user->access_token = json_encode($request->session()->get('token'));
//            $user->save();
//            dd("Successfully authenticated");
            dd($request->session()->get('filename'));
            $this->uploadFileUsingAccessToken($request);
        } else {
            //For Guest user, get google login url
            $authUrl = $this->gClient->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }

    public function uploadFileUsingAccessToken(Request $request) {
        dd($request->session()->get('fileurl'));
        $service = new \Google_Service_Drive($this->gClient);
//        $user = User::find(1);
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
        $fileMetadata = new \Google_Service_Drive_DriveFile(array('name' => 'ExpertPHP', 'mimeType' => 'application/vnd.google-apps.folder'));
        $folder = $service->files->create($fileMetadata, array('fields' => 'id'));
//        printf("Folder ID: %s\n", $folder->id);
        $file = new \Google_Service_Drive_DriveFile(['name' => $request->session()->get('filename'), 'parents' => array($folder->id)]);

        dd($request->session()->get('fileUrl'));
        $result = $service->files->create($file, ['data' => file_get_contents($request->session()->get('fileUrl')), 'mimeType' => 'application/octet-stream', 'uploadType' => 'media']);
        // get url of uploaded file
//        dd($result);
        // echo $url = 'https://drive.google.com/open?id=' . $result->id;
        return ($result->id) ? $result->id : false;
    }

}
