<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function add(){
        return view('admin.users.add');
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.users.edit',compact('user'));
    }
    
    public function index(){
        $users = User::where('role','admin')->get();
        return view('admin.users.index',compact('users'));
    }

    public function save(Request $request){
        $result = false;
		$errormessage = "";
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            
        ]);
        if ($validator->fails()) {
			return back()
				->withErrors($validator)
                ->withInput();
		} else {
			$result = true;
			
			try {
                if(isset($request->id) && strlen($request->id))
					$user = User::find($request->id);
				else
				    $user = new User;
				$user->name = $request->name;
				$user->email = $request->email;
				$user->role = 'admin';
				$user->email_verified_at = date('Y-m-d H:i:s');
				
                if(isset($request->password))
                    $user->password = Hash::make($request->password);

                if(isset($request->enabled))
					$user->verified = $request->enabled?1:0;
				else
					$user->verified = 1;
				
				if($user->save()){
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
			return redirect()->route('admin_users')->with('success','User saved successfully!');
		else
			return back()->with('error','User was not saved! '.$errormessage );
		
    }
}
