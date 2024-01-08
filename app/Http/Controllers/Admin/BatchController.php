<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BunnyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\Season;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Coach;
use App\Models\Subject;
use App\Models\Clas;
use App\Models\Enrollment;
use Vimeo\Laravel\VimeoManager;
use DB;

class BatchController extends Controller
{
	protected $bunny;
	public function __construct(VimeoManager $vimeo,BunnyService $bunny)
    {
        $this->vimeo = $vimeo;
        $this->bunny = $bunny;
    }
    
    public function add($id){
		$season = Season::find($id);
		$courses = Course::where('enabled',1)->with('subjects')->get();
        return view('admin.batches.add',compact('season','courses'));
    }

    public function edit($id){
		$batch = Batch::find($id);
		if($batch){
			
		}else{
			return back()->with('error','Invalid Batch ID! ' );
		}
		$courses = Course::where('enabled',1)->with('subjects')->get();
        $rawclasses = Clas::where('batch_id',$id)->get();
		$classes = [];
		foreach($rawclasses as $class){
			$classes[$class->course_id][$class->subject_id] = $class->id;
		}
        return view('admin.batches.edit',compact('batch','courses','classes'));
	}

	public function students(Request $request,$id){
		$query = Enrollment::query();
		
		$allinput = $request->all();
		Log::info($allinput);
		Log::info(isset($allinput['enrollments']));
		if(isset($allinput['enrollments'])){
			$result = true;
			foreach($allinput['enrollments'] as $enrollmentinput){
				
				if(isset($enrollmentinput['checked']) && $enrollmentinput['checked'] == "on"){
					$enrollment = Enrollment::find($enrollmentinput['id']);
					if($enrollment){
						$enrollment->verified = $enrollmentinput['verified'];
						$enrollment->amount_paid = $enrollmentinput['amount_paid'];
						$enrollment->payment_status = $enrollmentinput['payment_status'];
						$enrollment->passed = $enrollmentinput['passed'];
						if(!$enrollment->save()){
							$result = false;
							break;
						}
					}
				}
			}
		}
		
		$query->where('batch_id',$id);
		$query->with('student');
		
		$search = [];
		if(isset($allinput['search'])){
			$search = $allinput['search'];
			if(strlen($allinput['search']['first_name']) || strlen($allinput['search']['last_name'])){
				$query->whereHas('student', function ($query) use ($allinput) {
					if(strlen($allinput['search']['first_name'])){
						$query->where('first_name', 'like', $allinput['search']['first_name'].'%');
					}
					if(strlen($allinput['search']['last_name'])){
						$query->where('last_name', 'like', $allinput['search']['last_name'].'%');
					}
				});
			}
			if(strlen($allinput['search']['verified'])){
				$query->where('verified',$allinput['search']['verified']);
			}
		}
		
		$query->with('student.user');
		$enrolledstudents = $query->paginate(25);

		$batch = Batch::where('id',$id)->with('season')->first();
		$paymentstatuses = Enrollment::PAYMENT_STATUSES;

		return view('admin.batches.students',compact('batch','enrolledstudents','paymentstatuses','id','search'));
	}

	public function search(Request $request){
        $query = Student::query();

        $lastname = null;
        if(isset($request->last_name)){
            $query->where('last_name','like','%'.$request->last_name.'%');
            $lastname = $request->last_name;
        }

        $firstname = null;
        if(isset($request->first_name)){
            $query->where('first_name','like','%'.$request->first_name.'%');
            $firstname = $request->first_name;
        }

        $query->with('user');
        $students = $query->simplePaginate(25);
        if($firstname)
            $students->appends(['first_name' => $firstname]);
        if($lastname)
            $students->appends(['last_name' => $lastname]);
        return view('admin.batches.search',compact('students'));
    }
	
	public function enroll_students($id){
		
		$enrolledstudents = Enrollment::where('batch_id',$id);
		$batch = Batch::where('id',$id)->with('season')->first();
		
		return view('admin.batches.students',compact('batch','enrolledstudents'));
	}
	
	public function videos($classid){
		$class = Clas::where('id',$classid)
			->with('course')
			->with('subject')
			->with('batch')
			->with('batch.season')
			->first();
		if($class){
		} else {
			return back()->with('error','Invalid Class ID! ' );
		}	
		$albumvideos = [];	
			
		if( strlen($class->collection_id) ){
			$albumvideos = $this->vimeo->request($class->collection_id."/videos",['per_page'=>100],'GET');
		}else{
			//$collection = $this->bunny->createCollection($class->batch->season->name.'-'.$class->batch->name.'-'.$class->course->code.'-'.$class->subject->code);
			//var_dump($collection);
			//if($collection && isset($collection['guid'])){
			//	$class->collection_id = $collection['guid'];
			//	$class->save();
			//}
		}
		if (Cache::has('vimeo_albums_'.$class->collection_id)){
			Cache::forget('vimeo_albums_'.$class->collection_id);
		}
		$videos = [];
		//$videos = $this->vimeo->request("/me/videos",['per_page'=>100],'GET');
		//$videos = $this->bunny->getVideos();
		$pullzone = env('BUNNY_PULL_ZONE');
		Log:info($albumvideos);
		return view('admin.batches.videos',compact('class','videos','albumvideos','pullzone'));
	}
	public function videosv2($classid){
		$class = Clas::where('id',$classid)
			->with('course')
			->with('subject')
			->with('batch')
			->with('batch.season')
			->first();
		if($class){
		} else {
			return back()->with('error','Invalid Class ID! ' );
		}	
		$albumvideos = [];	
		$bunnyerror = false;
		if( strlen($class->vimeo_albumid) ){
			$getVideoResult = $this->bunny->getVideosWithStatus($class->vimeo_albumid);
			
			if($getVideoResult['status']){
				$albumvideos = $getVideoResult['videos'];
			}else{
				$bunnyerror= true;
			}
		}else{
			$collection = $this->bunny->createCollection($class->batch->season->name.'-'.$class->batch->name.'-'.$class->course->code.'-'.$class->subject->code);
			if($collection && isset($collection['guid'])){
				$class->vimeo_albumid = $collection['guid'];
				$class->save();
			}
		}
		if (Cache::has('vimeo_albums_'.$class->collection_id)){
			Cache::forget('vimeo_albums_'.$class->collection_id);
		}
		$videos = [];
		//$videos = $this->vimeo->request("/me/videos",['per_page'=>100],'GET');
		//$videos = $this->bunny->getVideos();
		$pullzone = env('BUNNY_PULL_ZONE');
		//Log:info($albumvideos);
		$collections = [];
		$rawcollections = $this->bunny->getCollections();
		
		if($bunnyerror){
			$allclasses = Clas::all();
			$colids = [];
			
			foreach($allclasses as $allclas){
				$colids[] = $allclas->vimeo_albumid;
			}
			
		}
		
		if($rawcollections && isset($rawcollections['items'])){
			foreach($rawcollections['items'] as $col){
				if(isset($colids) && $colids && in_array($col['guid'],$colids))
					continue;
				$collections[$col['guid']] = $col['name'];
			}
		}
		return view('admin.batches.videosv2',compact('class','videos','albumvideos','pullzone','collections','bunnyerror'));
	}
	
	public function update_collection(Request $request){
		$result = false;
		$errormessage = "";
		$data = $request->all();
		
		if(isset($data['class_id'])){
			$clas = Clas::find($data['class_id']);
			if($clas){
				if(isset($data['new_collection_id'])){
					$colid = $data['new_collection_id'];
					if($colid == 'NEWCOLLECTION'){
						$clas->load('batch');
						$clas->load('batch.season');
						$clas->load('course');
						$clas->load('subject');
						//$this->bunny->createCollection();
						$collection = $this->bunny->createCollection(time().'-'.$clas->batch->season->name.'-'.$clas->batch->name.'-'.$clas->course->code.'-'.$clas->subject->code);
						Log::info('NEW COLLECTION');
						Log::info($collection);
						if($collection){
							$colid = $collection["guid"];
						}
					}
					$clas->vimeo_albumid = $colid;
					$clas->save();
					$result = true;
				}
			}
		}
		
		if($result)
			return back()->with('success','Videos updated successfully!');
		else
			return back()->with('error','Videos was not updated! '.$errormessage )->withInput();
	}
	
	public function add_videos(Request $request){
		$result = false;
		$errormessage = "";
		$videos = $request->all();
		Log::info($videos);
        if ($videos) {
			
			try {
                foreach($videos['newvideo'] as $video){
					if(isset($video['id']) && strlen($video['id'])){
						$result = true;
						$albuminfo = $this->vimeo->request($videos['album_id'].$video['id'],[],'PUT');
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
			return back()->with('success','Video added successfully!');
		else
			return back()->with('error','Video was not saved! '.$errormessage )->withInput();
		
	}
	
	public function update_videos(Request $request){
		$result = false;
		$errormessage = "";
		$videos = $request->all();
		Log::info($videos);
        if ($videos) {
			
			try {
                foreach($videos['newvideo'] as $video){
					if(isset($video['id']) && strlen($video['id'])){
						$result = true;
						$videoinfo = $this->bunny->updateVideo($video);
						Log::info($videoinfo);
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
			return back()->with('success','Videos updated successfully!');
		else
			return back()->with('error','Videos was not updated! '.$errormessage )->withInput();
		
	}
    
	
    public function remove_videos(Request $request){
		$result = false;
		$errormessage = "";
		$video = $request->all();
		Log::info($video);
        if ($video) {
			
			try {
				if(isset($video['album_id']) && strlen($video['album_id']) && isset($video['video_id']) && strlen($video['video_id'])){
					$result = true;
					$albuminfo = $this->vimeo->request($video['album_id'].$video['video_id'],[],'DELETE');
					Log::info($albuminfo);
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
			return back()->with('success','Video was removed successfully!');
		else
			return back()->with('error','Video was not removed! '.$errormessage )->withInput();
		
	}
    public function view($batchid,$courseid = null,$subjectid = null){
        $batch = Batch::where('id',$batchid)->with('season')->first();
        if($batch){
		} else {
			return back()->with('error','Invalid Batch ID! ' );
		}
		$batchcourseids = Clas::where('batch_id',$batchid)->orderBy('id')->groupBy('course_id')->pluck('course_id')->toArray();
		$enrolledstudents = Enrollment::where('batch_id',$batchid)->groupBy('verified')->select(['verified',DB::raw('count(*) as total')])->get();
		$totalpayments = Enrollment::where('batch_id',$batchid)->select([DB::raw('sum(amount_paid) as total')])->first();
		$enrolledpayments = Enrollment::where('batch_id',$batchid)->groupBy('payment_status')->select(['payment_status',DB::raw('count(*) as total')])->get();
		$courses=[];
		$students=[
			'total' => 0,
			'verified' => 0,
			'notyet' => 0
		];
		$payments = [
			'paid' => 0,
			'partial' => 0,
			'others' => 0
		];
		foreach($enrolledstudents as $enrolledstudent){
			$students['total'] += $enrolledstudent->total;

			if($enrolledstudent->verified == 1){
				$students['verified'] += $enrolledstudent->total;
			}else{
				$students['notyet'] += $enrolledstudent->total;
			}
		}
		foreach($enrolledpayments as $enrolledstudent){
			
			if($enrolledstudent->payment_status == Enrollment::PAYMENT_COMPLETE){
				$payments['paid'] += $enrolledstudent->total;
			}elseif($enrolledstudent->payment_status == Enrollment::PAYMENT_PARTIAL){
				$payments['partial'] += $enrolledstudent->total;
			}else{
				$payments['others'] += $enrolledstudent->total;
			}
		}
		$class = [];
		$subjects = [];
		if($batchcourseids){

			if($courseid == null)
				$courseid = $batchcourseids[array_key_first ($batchcourseids)];
			
			$subjects = Subject::where('course_id',$courseid)->get()->pluck('code','id')->toArray();
			
			if($subjectid == null)
				$subjectid = array_key_first ($subjects);
		
			
			$class = Clas::where('batch_id',$batchid)
				->where('course_id',$courseid)
				->where('subject_id',$subjectid)
				->with('course')
				->with('subject')
				->with('coach')
				->with('attachments')
				->first();
			
			$courses = Course::whereIn('id',$batchcourseids)->where('enabled',true)->get()->pluck('code','id')->toArray();
		
			
		}	
		$coaches = Coach::where('enabled',1)->get();
		return view('admin.batches.view',compact('batch','courses','coaches','totalpayments','payments','class','subjects','batchid','courseid','subjectid','students'));
    }
    
    public function index($id){
        $batchs = Batch::where('season_id',$id)->get();
        return view('admin.batches.index',compact('batchs'));
    }

	public function save_class(Request $request){
		$result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'coach_id' => 'required',
            //'remarks' => 'required',
        ]);
        if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
		} else {
			
			
			try {
                if(isset($request->id) && strlen($request->id)){
					
					$result = true;

					$class = Clas::find($request->id);
				    
					$class->coach_id = $request->coach_id;
					$class->date_start = $request->date_start;
					$class->date_end = $request->date_end;
					$class->remarks = $request->remarks;
					
					if($class->save()){

						$result = true;
					}else{
						$result = false;
					}
				}
			}catch(\Exception $e){
				$result = false;
				$errormessage = $e->getMessage();
			}
		}
		if($result)
			return redirect()->route('admin_batch_view',['batchid'=>$class->batch_id,'courseid'=>$class->course_id,'subjectid'=>$class->subject_id])->with('success','Class updated successfully!');
		else
			return back()->with('error','Batch was not saved! '.$errormessage )->withInput();
		
	}
	public function syncClassVideos($classid){
		$clas = Clas::where('id',$classid)->first();
		if($clas){
			$videos = $this->bunny->getVideos($clas->vimeo_albumid);
			Log::info($videos);
			Cache::forever('vimeo_albums_'.$clas->vimeo_albumid,$videos);
		}
		return back();
	}
    
	public function syncAllClass(){
		$videocollections = ["ce272b4c-f9ad-4881-aa83-7f322262f733","3af41246-2454-4372-9432-bfe0b72799f4","9ba003a2-b25b-49fe-8091-7d991492fb50","06a2a87a-831b-42fc-84b4-d46a55ca7386","60298578-75ad-40f4-8316-ada736dc7267","85abc8cf-f3b0-4a34-8aa5-1793f7d69b6f","3d57f0bc-5663-44bb-9d86-d51acdb01e38","a6933b2e-8a9a-4667-9cae-c512942aed9e","4b239c3d-9b3f-4401-8cc6-fc570865d7df","facad843-13d5-4bbf-b1ff-eeeda265f9c3","71f24b81-d5cf-4d29-9979-2dc3725b3182","dab2266c-7719-4077-b6c8-498f9378eede","227feb06-f5be-4531-82f8-af7340edccf9","0891a980-faeb-4af7-9d24-eaebfd2f44d4","8c6e77e6-9044-487b-be0a-46c7de6cf52f","64e7f66b-64bf-4f38-86cd-9c34113b0863","a57f05cb-85d7-4c01-a422-2fcd23f0f341","411ad4f7-efef-463c-9684-1a03c8782dda","205379a1-585b-489d-abe6-76a9920b21dc","8e979577-9fea-40f5-8d99-86608bdc3156","50653cc8-968f-4d43-85eb-0d53560b65c7","55246dc7-4dcb-4c5a-9574-e6e6118b73d9","9d44466c-cf35-45dc-bb76-3ede70436c4b","cbfbe958-7f24-4e5d-a2b0-351ba9079ac3","818baf6e-043d-4158-bac5-04d4d3d5f3e7","d16c6665-71c1-4217-8140-e26624338ba5","4d6e7fef-bacc-4ceb-9a29-a29b83e2df0a","e63f3b33-313c-4e99-8861-c15d4b1e81e8","1a7d45cd-a5c1-4b63-adff-7bf31dceef8c","1f28fe12-6460-4472-8873-23d9c9686c97","4e831430-26fa-4e7b-ae38-5e0c8cc1e9b9","52ee2f0c-e89e-40ba-a286-7ec059961345","49df3e94-7d12-4b69-ae1c-00c4750dfb4b","00233159-2f41-4925-b8b4-f3eaf7d82d13","3ef8c1db-215c-4b63-8bb4-df7f252b306e","da0fe36d-c7dc-4321-921b-6ed131238d54","3ce85c75-c100-413f-a2a8-00e19b279e83","4e0ed065-f16b-4d95-bf5c-873bab0e00f3","7f9e0358-ac91-4e1d-bcbb-035758cec0e2","20ab88f2-6627-4068-b65d-2771cca7c4ee","a8518312-7e24-4e1f-9179-e64bdbd5bd02","dc3cd6a2-6c58-4bd5-8f06-65f85ce60252","3034ea4b-6f86-47f7-b917-b12c93eb8c42"];
		
		$clases = Clas::whereIn('vimeo_albumid',$videocollections)->get();
		foreach($clases as $clas){
			$this->syncClassVideos($clas->id);
		}
		
		return response()->json([
			'classes' => $clases
		]);
	}
    
	public function save(Request $request){
        $result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
		} else {
			$result = true;
			$batchid = null;
			try {
                if(isset($request->id) && strlen($request->id))
					$batch = Batch::find($request->id);
				else
                    $batch = new Batch;
                    
				$batch->name = $request->name;
				$batch->description = $request->description;
				$batch->season_id = $request->season_id;
				if(isset($request->enabled))
					$batch->enabled = $request->enabled;
				else
					$batch->enabled = 1;
				$batch->date_start = $request->date_start;
				$batch->date_end = $request->date_end;
				$batch->maximum = $request->maximum;
				$batch->sections = $request->sections;
				
				$batch->load('season');
				
				$subjectcodes = Subject::get()->pluck('code','id');
				$coursecodes = Subject::get()->pluck('code','id');
				
				if($batch->save()){
					$batchid = $batch->id;
					if(isset($request->courses)){
						foreach($request->courses as $course){
							if(isset($course['checked']) && $course['checked'] == "on"){
								$courseid = $course['id'];
								
								if(isset($course['subjects'])){
									foreach($course['subjects'] as $subject){
										if(isset($subject['checked']) && $subject['checked'] == "on"){
											$subjectid = $subject['id'];
		
											$clas = new Clas;
											$clas->subject_id = $subjectid;
											$clas->course_id = $courseid;
											$clas->batch_id = $batch->id;
											$clas->status = 1;
		
											if($clas->save()){
												
												//$this->bunny->createCollection();
												$collection = $this->bunny->createCollection($batch->season->name.'-'.$batch->name.'-'.$coursecodes[$courseid].'-'.$subjectcodes[$subjectid]);
												if($collection){
													$clas->vimeo_albumid = $collection["guid"];
													$clas->save();
												}
											}else{
												$result = false;
											}
										}
									}
								}
							}
						}
					}
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
			return redirect()->route('admin_batch_view',$batchid)->with('success','Batch saved successfully!');
		else
			return back()->with('error','Batch was not saved! '.$errormessage )->withInput();
		
    }
}
