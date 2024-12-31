<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\LiveStreamLink;
use App\Models\Season;
use Google\Service\YouTube\LiveStream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LiveStreamController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $seasons = Season::where('enabled', 1)->get();
        $livestream = LiveStreamLink::where('is_active', 1)->with('season')->paginate(10)->onEachSide(3);

        return view('student.portal.livestream', compact(['user', 'seasons', 'livestream']));
    }

    public function show(LiveStreamLink $liveStream)
    {   
        $user = Auth::user();
        if (!$liveStream || !$liveStream->is_active) {
            return view('student.portal.livefeed', ['user' => $user, 'livestream' => null]);
        }

        //validate if user is enrolled
        $studentID = $user->student->id;
        $seasonID = $liveStream->season_id;
        $is_enrolled = true;
        if($liveStream->season_id != 0){
            $is_enrolled = Season::where('id', $seasonID)
                    ->whereHas('batches.enrollments', function ($query) use ($studentID) {
                        $query->where('student_id', $studentID)
                              ->where('verified', 1);
                    })->exists();
        }
        
        
        return view('student.portal.livefeed', ['user' => $user,'is_enrolled'=>$is_enrolled,'livestream' => $liveStream]);
    }

    public function search(Request $request)
    {

        $query = LiveStreamLink::query();

        $streamname = null;
        if (isset($request->stream_name)) {
            $query->where('name', 'like', '%' . $request->stream_name . '%');
            $streamname = $request->stream_name;
        }

        $isActive = null;
        if (isset($request->is_active) && strlen($request->is_active)) {
            if ($request->is_active != 'all') {
                $query->where('is_active', $request->is_active);
                $isActive = $request->is_active;
            }
        }

        $branch = null;
        if (isset($request->branch) && strlen($request->branch) && $request->branch != 0) {
            $query->where('season_id', $request->branch);
            $branch = $request->branch;
        }

        $query->where('is_active', 1)->with('season');
        $livestream = $query->paginate(10)->onEachSide(3);
        if ($streamname)
            $livestream->appends(['stream_name' => $streamname]);
        if ($isActive)
            $livestream->appends(['is_active' => $isActive]);
        if ($branch)
            $livestream->appends(['branch' => $branch]);

        $seasons = Season::where('enabled', 1)->get();
        return view('student.portal.livestream', compact(['livestream', 'seasons']));
    }
}
