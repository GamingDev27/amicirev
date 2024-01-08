<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Token;
use App\Models\Clas;
use App\Models\ClasAttachment;
use Illuminate\Support\Str;
use Iman\Streamer\VideoStreamer;
class AttachmentController extends Controller
{
    public function saveChunk(Request $request){
        $time_start = microtime(true);
		$result = ['result'=>true];
        
        $header = $request->header('X-CAtt');
        $catt =  json_decode(base64_decode($header));
        $attachmentid = '';
        $filepath = storage_path('app').DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'videos'.DIRECTORY_SEPARATOR;
        $start = $request->header('X-CAttS');
        if($catt){
            if(isset($catt->class_id)){
                $attachment = new ClasAttachment;
                $attachment->name = $catt->name;
                $attachment->class_id = $catt->class_id;
                $attachmentid = 'ca_'.time().'_'.Str::random(10).'.'.pathinfo($catt->filename, PATHINFO_EXTENSION);;
                $attachment->filename = $filepath.$attachmentid;
                $filepath = $filepath.$attachmentid;
                $attachment->status = 1;
                if(isset($request->type))
                    $attachment->type = $request->type;
                else
                    $attachment->type = 1;
                if(!$attachment->save()){
                    $result['result'] = false;
                }
            }else if(isset($catt->attachmentid)){
                $filepath = $filepath.$catt->attachmentid;
            }
        }
        
        
        $result['attachmentid'] = $attachmentid;
        
        $file = fopen($filepath, "c");
        fseek($file, $start, SEEK_SET);
        fwrite($file, $request->getContent());
        fclose($file);
		
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start);
		Log::info('Exec:'.($execution_time*1000).'ms');
		
        return $result;
    }
	
	public function remove(Request $request){
		$result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
		} else {
			
			
			try {
                
					
				$result = true;

				$attachment = ClasAttachment::find($request->id);
				
				//$attachment->status = 3;//deleted
				if(file_exists($attachment->filename)){
					unlink($attachment->filename);
				}
				
				if($attachment->delete()){

					$result = true;
				}else{
					$result = false;
				}
				
			}catch(\Exception $e){
				$result = false;
				$errormessage = $e->getMessage();
			}
		}
		if($result)
			return back()->with('success','Attachment removed successfully!');
		else
			return back()->with('error','Attachment was not removed! '.$errormessage )->withInput();
		
	}
	
    public function saveChunkOriginalSlow(Request $request){
        $result = ['result'=>true];
        Log::info($request->all());

        if(!isset($request->id) || $request->id == null){
            $attachment = new ClasAttachment;
            $attachment->name = $request->name;
            $attachment->class_id = $request->class_id;
            $attachment->filename = storage_path('app').DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'videos'.DIRECTORY_SEPARATOR.'ca_'.time().'_'.preg_replace('@[^0-9a-z\.]+@i', '', $request->filename);
            $attachment->total = $request->size;
            $attachment->status = 1;
            if(isset($request->type))
                $attachment->type = $request->type;
            else
                $attachment->type = 1;
            
        }else{
            $attachment = ClasAttachment::find($request->id);
        }
        
        $attachment->processed = $request->proc;
        if(!$attachment->save()){
            $result['result'] = false;
        }
        $result['attachmentid'] = $attachment->id;
        
        $file = fopen($attachment->filename, "c");
        fseek($file, $request->start, SEEK_SET);
        fwrite($file, base64_decode($request->slice));
        fclose($file);

        return $result;
    }

    public function streamAttachment($id){
        $attachment = ClasAttachment::find($id);
        //return $attachment->toArray();
        VideoStreamer::streamFile($attachment->filename);
    }

	public function streamold($code){

        Log::info($_SERVER);

        $token = Token::where('token',$code)->where('status',1)->first();
        Log::info($token);
        Log::info(Auth::user()->id);
        $result = false;
        if($token){
            
            $attachment = ClasAttachment::where('id',$token->foreign_id)->first();
            
            if($token->seen == null || $token->seen == 0){
                $token->seen = 1;
            }else{
                $token->seen += 1;
            }
            $result = true;
            if($attachment->type == 1){
                if($token->seen == 1){
                    $token->status = 0;
                }
            }else if($attachment->type == 2 ){
                if(!isset($_SERVER['HTTP_RANGE'])){
                    $result = false;
                }else{
                    $range =explode('-',$_SERVER['HTTP_RANGE']);
                    Log::info(explode('-',$_SERVER['HTTP_RANGE']));
                    Log::info($range);
                    if(isset($range[1]) && strlen($range[1]))
                        $result = false;
                    Log::info($result);
                    
                }
                
            }

            if($result){
                if($token->save()){
                    Log::info(Auth::user()->id == $token->user_id);
                    if(Auth::user()->id == $token->user_id){
                        //$token->delete();
                        
                        if($attachment ){
                            if($attachment->type == 2)
                            VideoStreamer::streamFile($attachment->filename);
                            if($attachment->type == 1){
                                return Response::make(file_get_contents($attachment->filename), 200, [
                                    'Content-Type' => 'application/pdf',
                                //    'Content-Disposition' => 'inline; filename="'.$attachment->name.'.pdf"'
                                ]);
                            }
                        }
                    }
                }
            }
            
        }
        if(!$result){
            return response()->json(['message' => 'Unauthorized Access. Either Request Expired or Download was attempted.'], 403);
        }        
    }

    public function stream($code){

        Log::info($code);
        $token = Token::where('token',$code)->where('status',1)->first();
        Log::info($token);
        Log::info(Auth::user()->id);
        $result = false;
        if($token){
            
            $attachment = ClasAttachment::where('id',$token->foreign_id)->first();
            
            if($token->seen == null || $token->seen == 0){
                $token->seen = 1;
            }else{
                $token->seen += 1;
            }
            $result = true;
			if($token->seen == 2){
				$token->status = 0;
			}
            if($result){
                if($token->save()){
                    Log::info(Auth::user()->id == $token->user_id);
                    if(Auth::user()->id == $token->user_id){
                        if($attachment ){
							return Response::make(file_get_contents($attachment->filename), 200, [
								'Content-Type' => 'application/pdf',
							]);
                        }
                    }
                }
            }
            
        }
        if(!$result){
            return response()->json(['message' => 'Unauthorized Access. Either Request Expired or Download was attempted.'], 403);
        }        
    }
	
}
