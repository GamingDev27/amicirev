<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Token;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Iman\Streamer\VideoStreamer;
use Vimeo\Laravel\VimeoManager;
use Google_Client; 
use Google_Service_Drive;
class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VimeoManager $vimeo)
    {
        $this->vimeo = $vimeo;
    }
    

    

    public function test(){
		
		$client = new Google_Client();
		//$client->setAuthConfig('../storage/app/amicireviewcenter-522527e4c516.json');
		$client->setApplicationName("amicireviewcenter");
		$client->setClientId('514863164054-bnr3a96vtnsfvmett69k5b9s1m2fkohr.apps.googleusercontent.com');
		$client->setClientSecret('kskcM0cs3k5Yzotqwxa4tYdp');
		$client->setRedirectUri('https://amicireviewcenter.com/test');
		$client->setDeveloperKey("AIzaSyDoGtefRHOjwXVSb0FAIGQi0TNvEHS_A_Y");
		$client->addScope("https://www.googleapis.com/auth/drive");
		//$client->addScope("https://www.googleapis.com/auth/drive.appdata");
		//$client->addScope("https://www.googleapis.com/auth/drive.file");
		//$client->addScope("https://www.googleapis.com/auth/drive.metadata");
		//$client->addScope("https://www.googleapis.com/auth/drive.metadata.readonly");
		//$client->addScope("https://www.googleapis.com/auth/drive.photos.readonly");
		//$client->addScope("https://www.googleapis.com/auth/drive.readonly");
		//$client->addScope("email");
		//$client->addScope("profile");
		// authenticate code from Google OAuth Flow
		if (isset($_GET['code'])) {
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			var_dump($token);
			$client->setAccessToken($token["access_token"]);
			// get profile info
			//$google_oauth = new Google_Service_Oauth2($client);
			//$google_account_info = $google_oauth->userinfo->get();
			//$email =  $google_account_info->email;
			//$name =  $google_account_info->name;
			
			//echo "E $email.\n";
			//echo "N $name.\n";
		
			
			$driveService = new Google_Service_Drive($client);

			$searchResults = $driveService->files->get('16ZbURE_NY2dEcbFuJjkWbhXjPfXG-nb_');
			//$searchResults = $driveService ->files->listFiles(['q' => "mimeType contains 'video/'"]);
			var_dump($searchResults);
//			if (count($searchResults->getFiles()) == 0) {
//				echo "No files found.\n";
//			} else {
//				echo "Files:\n";
//				foreach ($searchResults->getFiles() as $file) {
					//var_dump($file);
					//$this->ListFolder($file->getID()) // recursively get all folders and sub folders
					
					
//				}
//			}
		  // now you can use this profile info to create account in your website and make user logged in.
		} else {
		  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
		}
		
		$optParams = array(
		//  'pageSize' => 1,
		//  'fields' => 'nextPageToken, files(id, name)'
		);
		
		
    }
	
}
