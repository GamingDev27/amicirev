<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Barangay;

class AddressController extends Controller
{
    public function get_cities($id){
        $cities = City::where('province_id',$id)->where('enabled',1)->pluck('name','id')->toArray();
		$barangays = array();
		if(count($cities)){
			$barangays = Barangay::where('city_id',array_key_first($cities))->where('enabled',1)->pluck('name','id');
		}
		
        return ['cities'=>$cities,'barangays'=>$barangays];
    }

    public function get_barangays($id){
        $barangays = Barangay::where('city_id',$id)->where('enabled',1)->pluck('name','id');
        return $barangays;
    }

}
