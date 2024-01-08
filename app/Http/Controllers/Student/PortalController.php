<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Services\BunnyService;

use App\Models\Season;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Coach;
use App\Models\Subject;
use App\Models\Clas;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Token;
use Vimeo\Laravel\VimeoManager;
class PortalController extends Controller
{
	protected $bunny;
	public function __construct(VimeoManager $vimeo,BunnyService $bunny)
    {
        $this->vimeo = $vimeo;
        $this->bunny = $bunny;
    }
    public function show($batchid,$courseid = null,$subjectid = null){
        $batch = Batch::where('id',$batchid)->with('season')->first();
        if($batch){
			
		}else{
			return back()->with('error','Invalid Batch ID! ' );
		}
		
		$batchcourseids = Clas::where('batch_id',$batchid)->orderBy('id')->groupBy('course_id')->pluck('course_id')->toArray();
		
		$userid = Auth::user()->id;
		$student = Student::where('auth_user_id',$userid)->first();
		$enrollment = Enrollment::where('student_id',$student->id)->where('batch_id',$batchid)->first();

		if($batchcourseids){

			if($courseid == null)
				$courseid = $batchcourseids[array_key_first ($batchcourseids)];
			
			$subjects = Subject::where('course_id',$courseid)->get();
			
			if($subjectid == null)
				$subjectid = $subjects[array_key_first ($subjects->toArray())]->id;
		
			
			$rawclasses = Clas::where('batch_id',$batchid)
				->with('coach')
				->with('attachments')
				->get();
			$classes = [];
			
			$attachmentids = [];
			foreach($rawclasses as $class){
				if($enrollment && $enrollment->verified == 1 && $class->attachments){
					foreach($class->attachments as $attachment){
						$attachmentids[] = $attachment->id;
					}
				}
			}
			$rawtokens = Token::whereIn('foreign_id',$attachmentids)
				->where('user_id',Auth::user()->id)
				->where('status',1)
				->get();

			$tokens = [];
			foreach($rawtokens as $token){
				$tokens[$token->foreign_id][]=$token->token;
			}
			Log::info($tokens);
			foreach($rawclasses as $class){
				if($enrollment && $enrollment->verified == 1 && $class->attachments){
					foreach($class->attachments as $attachment){
						$i = 0;
						if(isset($tokens[$attachment->id])){
							$i += count($tokens[$attachment->id]);
						}else{
							$tokens[$attachment->id] = [];
						}
						Log::info($attachment->id.':'.$i);
						for(;$i<10;$i++){
							$code = 'CA_'.time().Str::random(20);
							$token = new Token;
							$token->token = $code;
							$token->status = 1;
							$token->foreign_id = $attachment->id;
							$token->user_id = Auth::user()->id;

							if($token->save()){
								$tokens[$attachment->id][] = $token->token;
							}
						}

						
					}
				}

                $classes[$class->course_id][$class->subject_id] = $class;
            }
			$courses = Course::whereIn('id',$batchcourseids)->where('enabled',true)->get();
		
			$coaches = Coach::where('enabled',1)->get();
		}	

		if($tokens){
			$tokens = base64_encode(json_encode($tokens));
		}

		return view('student.portal.show',compact('batch','tokens','student','enrollment','courses','coaches','classes','subjects','batchid','courseid','subjectid'));
    }

    public function join(Request $request){
		$result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'batch_id' => 'required',
        ]);
        if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
		} else {
			
			try {
                	
				$result = true;

				$enrollment = new Enrollment;
				
				$enrollment->batch_id = $request->batch_id;
				$enrollment->student_id = $request->student_id;
				$enrollment->status = 1;
				$enrollment->payment_status = Enrollment::PAYMENT_NEW;

				if($enrollment->save()){

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
			return back()->with('success','Join request have been saved successfully!');
		else
			return back()->with('error','Join request was not saved! '.$errormessage );
		
	}

	public function showv2($batchid,$courseid = null,$subjectid = null){
		
        $batch = Batch::where('id',$batchid)->with('season')->first();
		
        if($batch){
		
		}else{
			return back()->with('error','Invalid Batch ID! ' );
		}
		
		$batchcourseids = Clas::where('batch_id',$batchid)->orderBy('id')->groupBy('course_id')->pluck('course_id')->toArray();
		
		$userid = Auth::user()->id;
		$student = Student::where('auth_user_id',$userid)->first();
		$enrollment = Enrollment::where('student_id',$student->id)->where('batch_id',$batchid)->first();

		if($batchcourseids){

			if($courseid == null)
				$courseid = $batchcourseids[array_key_first ($batchcourseids)];
			
			$subjects = Subject::where('course_id',$courseid)->get();
			
			if($subjectid == null)
				$subjectid = $subjects[array_key_first ($subjects->toArray())]->id;
		
			
			$rawclasses = Clas::where('batch_id',$batchid)
				->with('coach')
				->with('attachments')
				->get();
			$classes = [];
			
			$attachmentids = [];
			$albumids = [];
			$albums = [];
			foreach($rawclasses as $class){
				if($enrollment && $enrollment->verified == 1){
					if($class->attachments)
						foreach($class->attachments as $attachment){
							$token = new Token;
							$code = 'CA_'.time().Str::random(20);
							$token->token = $code;
							$token->status = 1;
							$token->foreign_id = $attachment->id;
							$token->user_id = Auth::user()->id;

							if($token->save()){
								$attachment->token = $token->token;
							}
							$attachmentids[] = $attachment->id;
						}
					
					if(strlen($class->vimeo_albumid)){
						$albums[$class->id] = $this->vimeo->request($class->vimeo_albumid."/videos", ['per_page' => 10], 'GET');
					}
				}
			}
			
			//Log::info(json_encode($albums,JSON_UNESCAPED_SLASHES));

			
			foreach($rawclasses as $class){
				$classes[$class->course_id][$class->subject_id] = $class;
            }
			$courses = Course::whereIn('id',$batchcourseids)->where('enabled',true)->get();
		
			$coaches = Coach::where('enabled',1)->get();
		}	

		return view('student.portal.showv2',compact('batch','student','enrollment','courses','coaches','classes','subjects','batchid','courseid','subjectid','albums'));
    }
    
	
	public function showv3($batchid,$courseid = null,$subjectid = null){
		
        $batch = Batch::where('id',$batchid)->with('season')->first();
		if($batch){
		
		}else{
			return back()->with('error','Invalid Batch ID! ' );
		}
		
		$batchcourseids = Clas::where('batch_id',$batchid)->orderBy('id')->groupBy('course_id')->pluck('course_id')->toArray();
		
		$userid = Auth::user()->id;
		$student = Student::where('auth_user_id',$userid)->first();
		$enrollment = Enrollment::where('student_id',$student->id)->where('batch_id',$batchid)->first();

		if($batchcourseids){

			if($courseid == null)
				$courseid = $batchcourseids[array_key_first ($batchcourseids)];
			
			$subjects = Subject::where('course_id',$courseid)->get();
			
			if($subjectid == null)
				$subjectid = $subjects[array_key_first ($subjects->toArray())]->id;
			
			$rawclasses = Clas::where('batch_id',$batchid)
				->with('coach')
				->with('attachments')
				->get();
			
			$classes = [];
			$attachmentids = [];
			$albumids = [];
			$albums = [];
			
			foreach($rawclasses as $class){
				if($enrollment && $enrollment->verified == 1){
					if($class->attachments)
						foreach($class->attachments as $attachment){
							$token = new Token;
							$code = 'CA_'.time().Str::random(20);
							$token->token = $code;
							$token->status = 1;
							$token->foreign_id = $attachment->id;
							$token->user_id = Auth::user()->id;

							if($token->save()){
								$attachment->token = $token->token;
							}
							$attachmentids[] = $attachment->id;
						}
					
					if(strlen($class->vimeo_albumid)){
						//$albums[$class->id] = $this->vimeo->request($class->vimeo_albumid."/videos", ['per_page' => 10], 'GET');
						
						if (Cache::has('vimeo_albums_'.$class->vimeo_albumid)){
							$album = Cache::get('vimeo_albums_'.$class->vimeo_albumid);
						}else{
							//$album = $this->vimeo->request($class->vimeo_albumid."/videos", ['per_page' => 10], 'GET');
							$album = $this->bunny->getVideos($class->vimeo_albumid);
							Cache::forever('vimeo_albums_'.$class->vimeo_albumid,$album);
						}
						
						$albums[$class->id] = $album;
					}
				}
			}
			
			//Log::info(json_encode($albums,JSON_UNESCAPED_SLASHES));
			
			
			foreach($rawclasses as $class){
				$classes[$class->course_id][$class->subject_id] = $class;
            }
			$courses = Course::whereIn('id',$batchcourseids)->where('enabled',true)->get();
		
			$coaches = Coach::where('enabled',1)->get();
		}	
		$pullzone = env('BUNNY_PULL_ZONE');
		$libid = env('BUNNY_VIDEO_LIBRARY_ID');
		return view('student.portal.showv3',compact('batch','student','enrollment','courses','coaches','classes','subjects','batchid','courseid','subjectid','albums','pullzone','libid'));
    }
    
}
