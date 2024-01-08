<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BunnyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\Season;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Coach;
use App\Models\Subject;
use App\Models\Clas;
use App\Models\Enrollment;
use DB;

class CallbackController extends Controller
{
	protected $bunny;
	public function __construct(BunnyService $bunny)
    {
        $this->bunny = $bunny;
    }
    
    public function update(){
		
		$result = true;
		$data = request()->all();
		Log::info('VIDEODATA - GetVideo');
		Log::info($data);
		
		if(isset($data['Status']) && ($data['Status'] == 3 || $data['Status'] == 7)){ //upload complete
			$videodata = $this->bunny->getVideo($data['VideoGuid']);
			if($videodata && isset($videodata["collectionId"])){
				$this->updateClassVideos($videodata["collectionId"]);
			}
		}
		
		return compact('result');
		
	}
	
	function updateClassVideos($collectionId){
		$clas = Clas::where('vimeo_albumid',$collectionId)->first();
		Log::info('updateClassVideos');
		Log::info($clas);
		if($clas){
			$videos = $this->bunny->getVideos($collectionId);
			Log::info($videos);
			Cache::forever('vimeo_albums_'.$clas->vimeo_albumid,$videos);
		}
	}
	
	function syncClassCollections(){
		$result = true;
		$messages = [];
		$classes = Clas::with('batch')
			->with('batch.season')
			->with('course')
			->with('subject')
			->where('vimeo_albumid','')
			->get();
		
		foreach($classes as $clas) {
			if(strlen($clas->vimeo_albumid)) {
				
			}else{
				$collection = $this->bunny->createCollection($clas->batch->season->name.'-'.$clas->batch->name.'-'.$clas->course->code.'-'.$clas->subject->code);
				if($collection){
					$clas->vimeo_albumid = $collection["guid"];
					$clas->save();
				}
			}
			
			$messages[] = 'vimeo_albums_'.$clas->vimeo_albumid;
			//$videos = $this->bunny->getVideos($clas->vimeo_albumid);
			//$messages[] = 'vimeo_albums_'.json_encode($videos);
			//Cache::forever('vimeo_albums_'.$clas->vimeo_albumid,$videos);
		}
		return compact('result','messages');
	}
}
