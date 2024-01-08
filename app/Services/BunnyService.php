<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class BunnyService
{

    public function __construct()
    {
    }

	public function createCollection($name){
		
		$bunnyurl = env('BUNNY_URL');
		$bunnyapikey = env('BUNNY_API_KEY');
		$bunnylibid = env('BUNNY_VIDEO_LIBRARY_ID');
		$response = Http::withHeaders([
				'AccessKey' => $bunnyapikey
			])
			->acceptJson()
			->post($bunnyurl.$bunnylibid."/collections",[
				'name' => $name
			]);
			
		if($response->successful()){
			return $response->json();
		}
		return [];
	}
	
	public function updateVideo($video){
		
		$bunnyurl = env('BUNNY_URL');
		$bunnyapikey = env('BUNNY_API_KEY');
		$bunnylibid = env('BUNNY_VIDEO_LIBRARY_ID');
		
		Log::info('updatevideo');
		Log::info($video);
		
		
		$response = Http::withHeaders([
				'AccessKey' => $bunnyapikey
			])
			->acceptJson()
			->post($bunnyurl.$bunnylibid."/videos/".$video['id'],[
				'title' => $video['title'],
				'collectionId' => $video['collectionId']
			]);
			
		if($response->successful()){
			return $response->json();
		}
		return [];
	}
	
	
	public function getCollections(){
		
		$bunnyurl = env('BUNNY_URL');
		$bunnyapikey = env('BUNNY_API_KEY');
		$bunnylibid = env('BUNNY_VIDEO_LIBRARY_ID');
		$response = Http::withHeaders([
				'AccessKey' => $bunnyapikey
			])
			->acceptJson()
			->get($bunnyurl.$bunnylibid."/collections",['itemsPerPage' => 1000,'page' => 1]);
			
		if($response->successful()){
			return $response->json();
		}
		return [];
	}
	public function getVideosWithStatus($collectionId = null)
	{
		
		$parameters = [
			//page=1&itemsPerPage=100&orderBy=date add search here
		];
		if($collectionId){
			$parameters['collection'] = $collectionId;
		}
		$bunnyurl = env('BUNNY_URL');
		$bunnyapikey = env('BUNNY_API_KEY');
		$bunnylibid = env('BUNNY_VIDEO_LIBRARY_ID');
		
		$response = Http::withHeaders([
				'AccessKey' => $bunnyapikey
			])
			->acceptJson()
			->get($bunnyurl.$bunnylibid."/videos",$parameters);
		$videos = [];
		$status = true;
		if($response->successful()){
			$videos = $response->json();
		}else{
			$status = false;
		}
		return compact('videos','status');
    }
	
    public function getVideos($collectionId = null)
	{
		
		$parameters = [
			//page=1&itemsPerPage=100&orderBy=date add search here
		];
		if($collectionId){
			$parameters['collection'] = $collectionId;
		}
		$bunnyurl = env('BUNNY_URL');
		$bunnyapikey = env('BUNNY_API_KEY');
		$bunnylibid = env('BUNNY_VIDEO_LIBRARY_ID');
		$response = Http::withHeaders([
				'AccessKey' => $bunnyapikey
			])
			->acceptJson()
			->get($bunnyurl.$bunnylibid."/videos",$parameters);
		if($response->successful()){
			return $response->json();
		}
		return [];
    }
	
	public function getVideo($videoId = null)
	{
		
		$bunnyurl = env('BUNNY_URL');
		$bunnyapikey = env('BUNNY_API_KEY');
		$bunnylibid = env('BUNNY_VIDEO_LIBRARY_ID');
		$response = Http::withHeaders([
				'AccessKey' => $bunnyapikey
			])
			->acceptJson()
			->get($bunnyurl.$bunnylibid."/videos/".$videoId);
		if($response->successful()){
			return $response->json();
		}
		return [];
    }
}
