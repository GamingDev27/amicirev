<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function add($id){

        $course = Course::find($id);
        return view('admin.subjects.add',compact('course'));

    }

    public function edit($id){
        $subject = Subject::find($id);
        return view('admin.subjects.edit',compact('subject'));
    }
    
    public function index(){
        $subjects = Subject::all();
        return view('admin.subjects.index',compact('subjects'));
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
					$subject = Subject::find($request->id);
				else
				    $subject = new Subject;
				$subject->name = $request->name;
				$subject->code = $request->code;
				$subject->course_id = $request->course_id;
				$subject->description = $request->description;
				$subject->enabled = 1;
				$subject->user_id = Auth::user()->id;
				
				if($subject->save()){
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
			return redirect()->route('admin_courses')->with('success','Subject saved successfully!');
		else
			return back()->with('error','Subject was not saved! '.$errormessage );
		
    }
}
