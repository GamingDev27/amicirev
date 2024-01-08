<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coach;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class CoachController extends Controller
{

    public function add(){
        return view('admin.coaches.add');
    }

    public function edit($id){
        $coach = Coach::find($id);
        return view('admin.coaches.edit',compact('coach'));
    }
    
    public function index(){
        $coachs = Coach::get();
        return view('admin.coaches.index',compact('coachs'));
    }

    public function save(Request $request){
        $result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'license' => 'required',
        	'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
		} else {
			$result = true;
			
			try {
                if(isset($request->id) && strlen($request->id))
					$coach = Coach::find($request->id);
				else
				    $coach = new Coach;
				$coach->first_name = $request->first_name;
				$coach->last_name = $request->last_name;
				$coach->middle_name = $request->middle_name;
				$coach->title = $request->title;
				$coach->salutation = $request->salutation;
				$coach->license = $request->license;
				$coach->accomplishments = $request->accomplishments;
				if(isset($request->enabled))
					$coach->enabled = $request->enabled?1:0;
				else
					$coach->enabled = 1;
				
				$coach->user_id = Auth::user()->id;
				
				if(isset($request->image)){
					$imageName = 'coach_'.time().'.'.$request->image->extension();  
					$request->image->move(public_path('images'), $imageName);
					$coach->image = $imageName;
				}
				if($coach->save()){
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
			return redirect()->route('admin_coaches')->with('success','Coach saved successfully!');
		else
			return back()->with('error','Coach was not saved! '.$errormessage );
		
    }
}
