<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Enrollment;
use DB;
class DashboardController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}
	
	public function index() {

		$seasons = Season::with(["batches" => function($q){
				$q->where('batches.enabled', 1);
			}])->get();
	
		$enrolledstudents = Enrollment::groupBy('batch_id','verified')->select(['batch_id','verified',DB::raw('count(*) as total')])->get();
		$totalpayments = Enrollment::groupBy('batch_id')->select(['batch_id',DB::raw('sum(amount_paid) as total')])->get();
		$enrolledpayments = Enrollment::groupBy('batch_id','payment_status')->select(['batch_id','payment_status',DB::raw('count(*) as total')])->get();
		$enrolledpassed = Enrollment::groupBy('batch_id','passed')->select(['batch_id','passed',DB::raw('count(*) as total')])->get();
		
		$students = [];
		$payments = [];
		$collections = [];
		$passingrate = [];
		$enrollmentrate = [];
		$passingtally = [];
		

		foreach($totalpayments as $totalpayment){
			$collections[$totalpayment->batch_id] = $totalpayment->total;
		}
		foreach($enrolledpassed as $enrolledstudent){
			
			if(!isset($passingtally[$enrolledstudent->batch_id])){
				$passingtally[$enrolledstudent->batch_id] = [
					'passed' => 0,
					'failed' => 0,
					'notyet' => 0,
					'total' => 0
				];
			}
			$passingtally[$enrolledstudent->batch_id]['total'] += $enrolledstudent->total;
			if($enrolledstudent->passed == 1){
				$passingtally[$enrolledstudent->batch_id]['passed'] += $enrolledstudent->total;
			}elseif($enrolledstudent->passed === 0){
				$passingtally[$enrolledstudent->batch_id]['failed'] += $enrolledstudent->total;
			}else{
				$passingtally[$enrolledstudent->batch_id]['notyet'] += $enrolledstudent->total;
			}
		}
		
		foreach($passingtally as $branchid => $tally){
			$passingrate[$branchid] = ceil(($tally['passed']/$tally['total']) * 100);
		}

		foreach($enrolledstudents as $enrolledstudent){
			
			if(!isset($payments[$enrolledstudent->batch_id])){
				$students[$enrolledstudent->batch_id] = [
					'total' => 0,
					'verified' => 0,
					'notyet' => 0
				];
			}
			$students[$enrolledstudent->batch_id]['total'] += $enrolledstudent->total;

			if($enrolledstudent->verified == 1){
				$students[$enrolledstudent->batch_id]['verified'] += $enrolledstudent->total;
			}else{
				$students[$enrolledstudent->batch_id]['notyet'] += $enrolledstudent->total;
			}
		}

		foreach($students as $branchid => $tally){
			$enrollmentrate[$branchid] = $tally['total'];
		}

		foreach($enrolledpayments as $enrolledstudent){
			if(!isset($payments[$enrolledstudent->batch_id])){
				$payments[$enrolledstudent->batch_id] = [
					'paid' => 0,
					'partial' => 0,
					'others' => 0
				];
			}
			if($enrolledstudent->payment_status == Enrollment::PAYMENT_COMPLETE){
				$payments[$enrolledstudent->batch_id]['paid'] += $enrolledstudent->total;
			}elseif($enrolledstudent->payment_status == Enrollment::PAYMENT_PARTIAL){
				$payments[$enrolledstudent->batch_id]['partial'] += $enrolledstudent->total;
			}else{
				$payments[$enrolledstudent->batch_id]['others'] += $enrolledstudent->total;
			}
		}
		return view('admin.dashboard',compact('seasons','students','payments','collections','passingtally','passingrate','enrollmentrate'));
	}
}
