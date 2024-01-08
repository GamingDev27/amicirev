<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ClasAttachment;
class SeasonController extends Controller
{

    public function add(){
        return view('admin.seasons.add');
    }

    public function edit($id){
        $season = Season::find($id);
        return view('admin.seasons.edit',compact('season'));
    }
    
    public function index(){
        $seasons = Season::all();
        return view('admin.seasons.index',compact('seasons'));
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
			
			try {
                if(isset($request->id) && strlen($request->id))
					$season = Season::find($request->id);
				else
				    $season = new Season;
				$season->name = $request->name;
				$season->description = $request->description;
				$season->enabled = 1;
				$season->exam_date_start = $request->exam_date;
				
				if($season->save()){
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
			return redirect()->route('admin_season_index')->with('success','Season saved successfully!');
		else
			return back()->with('error','Season was not saved! '.$errormessage );
		
    }
	
	public function get_attachments(Request $request){
		$data = ["result" => 0];
		Log::info($_POST);
		Log::info($request->getContent());
		$cred = json_decode($request->getContent());
		$output = "";
		if(isset($cred->email) && isset($cred->password)){
			if (Auth::attempt(["email"=>$cred->email,"password"=>$cred->password])) {
				$attachments = ClasAttachment::where('type',1)->where('status',1)->get(['id','name','class_id']);
				$seasons = Season::where('enabled',1)
					->with("batches")
					->with("batches.classes")
					->with("batches.classes.course")
					->with("batches.classes.subject")
					->get();
					
				
				foreach($seasons as $season){
					$output .= "{".$season->name;
					foreach($season->batches as $batch){
						if($batch->enabled == 1){
							$output .= "(".$batch->name;
							$clases = [];
							foreach($batch->classes as $class){
								$clases[$class->course->name][$class->subject->name] = $class->id;
							}
							foreach($clases as $course => $subjects){
								$output .= "[".$course;
								foreach($subjects as $subject => $classid){
									$output .= "+".$subject."=".$classid;
								}
								$output .= "]";
							}
							$output .= ")";
						}
					}
					$output .= "}";
				}
				$data['seasons'] = $seasons;
				//$data['attachments'] = $attachments;
				
			}
		}
		
		return $output;
	}
	
	public function save_attachments(Request $request){
		$output = 0;
		Log::info($request->getContent());
		$cred = json_decode($request->getContent());
		$filepath = storage_path('app').DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'videos'.DIRECTORY_SEPARATOR;
        
		if(isset($cred->email) && isset($cred->password) && isset($cred->classid) && isset($cred->name) && isset($cred->filename)){
			if (Auth::attempt(["email"=>$cred->email,"password"=>$cred->password])) {
				
				Log::info("here");
		
				$attachment = new ClasAttachment;
				$attachment->class_id = $cred->classid;
				$attachment->name = $cred->name;
				$attachment->type = 1;
				$attachment->status = 1;
				$attachment->filename = $filepath.$cred->filename;
				if($attachment->save()){
					$output = 1;
				}else{
					Log::info("not saved");
				}
			}
		}
		return $output;
	}
}
