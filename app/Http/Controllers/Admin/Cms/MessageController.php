<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;
class MessageController extends Controller
{
    public function index(){
		$messages = Message::where('status',1)->orderBy('created_at','desc')->simplePaginate(10);
		return view('admin.messages.index',['messages'=>$messages]);
	}

	public function save_message(Request $request)
    {
		$result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required',
            'name' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
			return redirect('/home')
				->withErrors($validator)
                ->withInput();
		} else {
			$result = true;
			
			try {
				$message = new Message;
				$message->message = $request->message;
				$message->email = $request->email;
				$message->phone = $request->phone;
				$message->name = $request->name;
				$message->status = 1;
				
				if($message->save()){
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
			return back()->with('success','Massage saved successfully!');
		else
			return redirect()->route('home')->with('error','Massage was not saved! '.$errormessage );
		
	}
}
