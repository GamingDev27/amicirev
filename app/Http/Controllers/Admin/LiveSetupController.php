<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveStreamLink;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiveSetupController extends Controller
{
    public function index(){
        $seasons = Season::where('enabled', 1)->get();
        $livestream = LiveStreamLink::all();
        return view('admin.live.index',compact(['seasons','livestream']));
    }

    public function add(){
        $seasons = Season::where('enabled', 1)->get();
        return view('admin.live.add',compact('seasons'));
    }

    public function edit($id){
        $seasons = Season::where('enabled', 1)->get();
        $livestream = LiveStreamLink::find($id);
        return view('admin.live.edit',compact(['livestream','seasons']));
    }
    
    public function save(Request $request){
        $errormessage = "";
		$validator = Validator::make($request->all(), [
            'name' 		   => 'required',
            'description'  => 'required',
            'date_stream'  => 'required|date_format:Y-m-d\TH:i',
            'link' 		   => 'required',
            
        ]);
        if ($validator->fails()) {
			dd($validator->errors());
			return back()
				->withErrors($validator)
                ->withInput();
		} 
		
		$link = new LiveStreamLink();
		$link->name        = $request->name;
		$link->description = $request->description;
		$link->season_id   = $request->branch;
		$link->date_stream = $request->date_stream;
		$link->link        = $request->link;
		$link->is_active   = 1;
		if(!$link->save()){
			return back()->with('error','Link was not saved!');
		}

		return redirect()->route('admin_live_setup')->with('success','Link saved successfully!');
	}

	public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'id' 		   => 'required|exists:livestreamlink,id',
        ]);
        if ($validator->fails()) {
			return back()->with('error','Link record not found!');				
		} 
		
		$link = LiveStreamLink::find($request->id);
		$link->is_active = 0;	
		if(!$link->save()){
			return back()->with('error','Link was not saved!');
		}
		return redirect()->route('admin_live_setup')->with('success','Link tag as inactive!');
	}

	public function update(Request $request){
		$errormessage = "";
		$validator = Validator::make($request->all(), [
			'id' 		   => 'required|exists:livestreamlink,id',
			'name' 		   => 'required',
			'description'  => 'required',
			'branch'     => 'required',
			'date_stream'  => 'required|date_format:Y-m-d H:i:s',
			'link' 		   => 'required',
			
		]);
		if ($validator->fails()) {
			return back()
				->withErrors($validator)
				->withInput();
		} 
		
		$link = LiveStreamLink::find($request->id);
		$link->name        = $request->name;
		$link->description = $request->description;
		$link->season_id   = $request->branch;
		$link->date_stream = $request->date_stream;
		$link->link        = $request->link;
		$link->is_active   = $request->is_active;
		if(!$link->save()){
			return back()->with('error','Link was not saved!');
		}

		return redirect()->route('admin_live_setup')->with('success','Link saved successfully!');
	}
}
