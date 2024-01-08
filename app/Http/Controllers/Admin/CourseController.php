<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class CourseController extends Controller
{
    public function add(){
        return view('admin.courses.add');
    }

    public function edit($id){
        $course = Course::find($id);
        return view('admin.courses.edit',compact('course'));
    }
    
    public function index(){
        $courses = Course::with('subjects')->get();
        return view('admin.courses.index',compact('courses'));
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
					$course = Course::find($request->id);
				else
				    $course = new Course;
                $course->code = $request->code;
                $course->name = $request->name;
				$course->description = $request->description;
				if(isset($request->enabled))
					$course->enabled = $request->enabled?1:0;
				else
					$course->enabled = 1;
				$course->user_id = Auth::user()->id;
				
				if($course->save()){
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
			return redirect()->route('admin_courses')->with('success','Course saved successfully!');
		else
			return back()->with('error','Course was not saved! '.$errormessage );
		
    }
}
