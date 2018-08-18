<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\HostDestination;
use App\Models\Host;

class HostSearchController extends Controller
{
    public static function search(Request $request)
    {
    	$input = $request->all();
    	$dest = $input['destination'];
    	$adult = $input['adult'];
    	$children = $input['children'];
    	$checkIn = $input['start_date_time'];
    	$checkOut = $input['end_date_time'];
    	$facility = $request->input('facility');
    	$type = $request->input('type');
    	$rent="";
    	if ($request->input('rent')) {
    		$rent = $request->input('rent');
    	}
    	
    	/*return $type;*/
    	/*return count($facility);*/
    	$result = array();
    	//return $facility;
    	$dests = Host::searchHostDestination($dest,$adult,$children,$checkIn,$checkOut,$rent)->toArray();

		$hostInfos = Host::get();

		if ($facility) {
	    	foreach ($facility as $value) {	
	    		//return count($hostInfos);
	    		foreach ($hostInfos as $host) {
	    			$countFacility = count($host['p_facility']);

	    			for ($i=0; $i < $countFacility ; $i++) { 
	    				if($host['p_facility'][$i] == $value){
	    					$result[]=$host;
	    				}
	    			}
	    		}

	    	}
		}

		if ($type) {
	    	foreach ($type as $val) {	
	    		//return count($hostInfos);
	    		foreach ($hostInfos as $host) {
	    			$countType = count($host['p_type']);

	    			for ($i=0; $i < $countType ; $i++) { 
	    				if($host['p_type'][$i] == $val){
	    					$result[]=$host;
	    				}
	    			}
	    		}

	    	}
		}
    	

    	for ($d=0; $d < count($dests); $d++) { 
    		$normalId = Host::findOrFail($dests[$d]['_id']);
    		$result[]=$normalId;
    	}
    	$resultHosts = array_unique($result);
    	/*return $resultHosts;
    	exit;*/
    	
    	//return array_unique($data);
    	return view('frontend.hosts.search_result',compact('resultHosts'));
    }
}
