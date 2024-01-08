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
class HomeController extends Controller
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
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$members = Content::where('enabled',1)->where('type',Content::TYPE_MEMBER)->get();
		$about = Content::where('type',Content::TYPE_ABOUT)->first();
        $contact = Content::where('type',Content::TYPE_CONTACT)->first();
        return view('home.index',compact('members','about','contact'));
    }
    
    public function watch(Request $request){
        $code = 'C_'.time().Str::random(20);
        //$code = "C_1614305210PBGEjDR8YCfl2lwTKFNY";
		$albumvideos = $this->vimeo->request("/me/videos",[
		  "upload"=> [
			"approach"=> "pull",
			//"size"=> "1GB",
			"link"=> "http://drive.google.com/uc?export=download&id=1_2RcA6KQRws1tSQHYZAgymyhv9CUSpbr"
		  ]
		],'POST');
		return $albumvideos;
		/*
        $token = new Token;
        $token->token = $code;
        $token->status = 1;
        $token->user_id = null;//Auth::user()->id;

        if($token->save()){

        }
        
        return view('home.watch',compact('code'));
		*/
    }

    public function stream(Request $request,$code){
        //$token = Token::where('token',$code)->where('status',1)->first();
       // Log::info($token);
        //if($token){

         //   $token->status = 0;
         //   if($token->save()){
//
         //   }
            

            $filepath = storage_path('app').DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'videos'.DIRECTORY_SEPARATOR.'ca_1615035473_eXSKzLpFKr.mov';

            VideoStreamer::streamFile($filepath);
        //}else{
        //    return response()->json(['message' => 'Invalid Code.'], 403);
        //}
    }
	
}
