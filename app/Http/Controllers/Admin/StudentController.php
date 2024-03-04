<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SessionModel;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Arr;

use function PHPUnit\Framework\isNull;

class StudentController extends Controller
{

    public function search(Request $request)
    {

        $query = Student::query();

        if (isset($request->students) && isset($request->manual_verify) && strlen($request->manual_verify)) {
            $userids = [];

            // Get all checked user ids
            foreach ($request->students as $student) {
                if (isset($student['checked']) && $student['checked'] == "on")
                    $userids[] = $student['user_id'];
            }

            // Verify or Unverify user
            if (in_array($request->manual_verify, ['1', '2'])) {
                $verified = 0;
                if ($request->manual_verify == 1) $verified = 1;

                //Set change value of verified field
                if (isset($verified) && $userids) {
                    User::whereIn('id', $userids)
                        ->update(['verified' => $verified]);
                }
            }
            // End user session
            if ($request->manual_verify == '3') {
                User::whereIn('id', $userids)
                        ->update(['remember_token' => null]);
                SessionModel::whereIn('user_id', $userids)->delete();
            }
        }

        $lastname = null;
        if (isset($request->last_name)) {
            $query->where('last_name', 'like', '%' . $request->last_name . '%');
            $lastname = $request->last_name;
        }

        $firstname = null;
        if (isset($request->first_name)) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
            $firstname = $request->first_name;
        }

        $email = null;
        if (isset($request->email) && strlen($request->email)) {
            if ($request->email == 1)
                $query->whereHas('user', function ($q) {
                    $q->whereRaw('email_verified_at is not null');
                });
            else if ($request->email == 2)
                $query->whereHas('user', function ($q) {
                    $q->whereRaw('email_verified_at is null');
                });

            $email = $request->email;
        }

        $manual = null;
        if (isset($request->manual) && strlen($request->manual)) {
            if ($request->manual == 2)
                $query->whereHas('user', function ($q) {
                    $q->where('verified', 0)->orWhereNull('verified');
                });
            else if ($request->manual == 1)
                $query->whereHas('user', function ($q) {
                    $q->where('verified', 1);
                });
            $manual = $request->manual;
        }

        $query->with('user');
        $students = $query->paginate(15)->onEachSide(3);
        if ($firstname)
            $students->appends(['first_name' => $firstname]);
        if ($lastname)
            $students->appends(['last_name' => $lastname]);
        if ($email)
            $students->appends(['email' => $email]);
        if ($manual)
            $students->appends(['manual' => $manual]);

        return view('admin.students.search', compact('students'));
    }

    public function profile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
        }
        return view('');
    }

    public function list(Request $request)
    {
    }

    public function unverified(Request $request)
    {
    }
}
