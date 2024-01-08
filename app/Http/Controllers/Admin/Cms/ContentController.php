<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;
class ContentController extends Controller
{
    public function team(){
		$members = Content::where('type',Content::TYPE_MEMBER)->get();
		return view('admin.contents.team',['members'=>$members]);
	}
	
	public function about(){
		$about = Content::where('type',Content::TYPE_ABOUT)->first();
		return view('admin.contents.about',['type'=>Content::TYPE_ABOUT,'about'=>$about]);
	}
	public function contact(){
		$about = Content::where('type',Content::TYPE_CONTACT)->first();
		return view('admin.contents.contact',['type'=>Content::TYPE_CONTACT,'about'=>$about]);
	}
	

	public function team_add(){
		
		return view('admin.contents.team_add',['type' => Content::TYPE_MEMBER]);
	}
	
	public function team_edit($id){
		$content = Content::find($id);

		if($content){

		}else{
			return back()->with('error','Invalid Content ID! ' );
		}
		return view('admin.contents.team_edit',['type' => Content::TYPE_MEMBER,'content' => $content]);
	}

	public function save_content(Request $request){
		$result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'details' => 'required',
			'type' => 'required',
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
					$content = Content::find($request->id);
				else
					$content = new Content;
				$content->title = $request->title;
				$content->description = $request->description;
				$content->details = $request->details;
				$content->type = $request->type;

				if(isset($request->enabled))
					$content->enabled = $request->enabled?1:0;
				else
					$content->enabled = 1;
				if(isset($request->image))	{
					$imageName = time().'.'.$request->image->extension();  
					$request->image->move(public_path('images'), $imageName);
					$content->image = $imageName;
				}

				

				if($content->save()){
					$result = true;
				}else{
					$result = false;
				}
			}catch(\Exception $e){
				$result = false;
				$errormessage = $e->getMessage();
			}
		}

		$redirectTo = 'admin_team';
		if(isset($request->redirectTo))
			$redirectTo = $request->redirectTo;
		
		if($result)
			return redirect()->route($redirectTo)->with('success','Content saved successfully!');
		else
			return back()->with('error','Content was not saved! '.$errormessage )->withInput();;
		
	}
}
