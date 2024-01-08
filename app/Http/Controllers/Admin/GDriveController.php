<?php

namespace App\Http\Controllers\Admin;


use App\Models\Message;
use App\Models\Token;
use App\Models\Content;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Iman\Streamer\VideoStreamer;
use Vimeo\Laravel\VimeoManager;
use Google_Client; 
use Google_Service_Drive;
class GDriveController extends Controller
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
    

    

    public function videos(Request $request){
		
		$client = new Google_Client();
		//$client->setAuthConfig('../storage/app/amicireviewcenter-522527e4c516.json');
		$client->setApplicationName("amicireviewcenter");
		$client->setClientId('514863164054-bnr3a96vtnsfvmett69k5b9s1m2fkohr.apps.googleusercontent.com');
		$client->setClientSecret('kskcM0cs3k5Yzotqwxa4tYdp');
		$client->setRedirectUri($request->url());
		$client->setDeveloperKey("AIzaSyDoGtefRHOjwXVSb0FAIGQi0TNvEHS_A_Y");
		$client->addScope("https://www.googleapis.com/auth/drive");
		$client->addScope("https://www.googleapis.com/auth/drive.metadata");
		$client->addScope("https://www.googleapis.com/auth/drive.metadata.readonly");
		$videos = [];
		
		$gsigninlink = "";
		
		$code = $request->code;
		$errormessage = "";
		$noauth = true;
		if (isset($code) && strlen($code) && !is_null($code)) {
			$token = $client->fetchAccessTokenWithAuthCode($code);
			if(isset($token["access_token"])){
				$noauth = false;
				$client->setAccessToken($token["access_token"]);
				
				$driveService = new Google_Service_Drive($client);

				$searchResults = $driveService ->files->listFiles([
					'q' => "mimeType contains 'video/'",
					'fields' => 'nextPageToken, files(thumbnailLink, webContentLink,id,name,mimeType,size,parents)'
				]);
				if (count($searchResults->getFiles()) == 0) {
					
				} else {
					
					foreach ($searchResults->getFiles() as $file) {
						//Log::info($file);
						$videos[] = [
							'id' => $file->getID(),
							'name' => $file->getName(),
							'size' => $file->getSize(),
							'mime' => $file->getMimeType(),
							'link' => $file->getWebContentLink(),
							'thumbnail' => $file->getThumbnailLink()
						];
						
					}
				}
			}else{
				if(isset($token["error"]) && isset($token["error_description"])){
					$errormessage = $token["error"].":".$token["error_description"];
				}
			}
		  // now you can use this profile info to create account in your website and make user logged in.
		} 
		if($noauth)
			$gsigninlink = $client->createAuthUrl();
		
		return view('admin.gdrive.videos',compact('code','videos','gsigninlink','errormessage','noauth'));
		
    }
	public function import_videos(Request $request){
		
		$result = false;
		$errormessage = "";
		$videos = $request->all();
		Log::info($videos);
        if ($videos) {
			try {
                foreach($videos['importvideo'] as $video){
					if(isset($video['link']) && strlen($video['link'])){
						Log::info($video);
						$result = true;
						$albuminfo = $this->vimeo->request("/me/videos",[
							"upload"=> [
								"approach"=> "pull",
								"link"=> $video['link']
							],
							"name" => $video['name']
						],'POST');
						Log::info($albuminfo);
						
					}
				}
			}catch(\Exception $e){
				$result = false;
				$errormessage = $e->getMessage();
			}
		} else {
			
			return back()
				->withInput();
			
		}
		if($result)
			return back()->with('success','Video imported successfully!');
		else
			return back()->with('error','Video was not imported! '.$errormessage )->withInput();
		
	}
}
