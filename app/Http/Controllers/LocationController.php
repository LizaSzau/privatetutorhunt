<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Location;
use View;
use Auth;
use DB;

class LocationController extends Controller
{	
	private $max = 3;
	
    public function __construct()
    {

    }

//------------------------------------------------------------------------------
// formLocationGET
//------------------------------------------------------------------------------

	public function formLocationGET()
	{  
		$tutor = User::find(Auth::id())->tutor;
		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		$locations = Tutor::find($tutor->id)->locations;

		$data = array(
			'tutor_ready' => $tutor_ready,
			'locations' => $locations
		);
		
		return view('user.profile-location')->with($data);
	}
	
//******************************************************************************
// formLocationPOST
//******************************************************************************

	public function formLocationUploadPOST(Request $request) {
		
		$validator = Validator::make($request->all(), [
			'address' => 'required|max:50',
			'lat' => 'required|numeric|between:-90,90',
			'lng' => 'required|numeric|between:-180,180',
		]);
		
		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor = User::find(Auth::id())->tutor;
		$count = $tutor->locations()->count();
		
		if ($count >= $this->max) return response()->json(array('success' => 'NO', 200));	
		
		$tutor_id = $tutor->id;
		$location = new Location;
		
		$count_loc = $tutor->locations()
                    ->where('address', $request->address)
                    ->count();
					
		if ($count_loc == 0) {				
			$location->tutor_id = $tutor_id;
			$location->address = $request->address;
			$location->lat = $request->lat;
			$location->lng = $request->lng;
			$location->save();
			$location_id = $location->id;
			
			$tutor_ready = Tutor::find($tutor->id)->tutorReady;
			$tutor_ready->location = 1;
			$tutor_ready->save();
		
			return response()->json(array('success' => 'OK', 'location_id' => $location_id, '200'));	
		} else {
			return response()->json(array('success' => 'IN', 200));	
		}
	}
	
//******************************************************************************
// Delete location
//******************************************************************************

	public function formLocationDeletePOST(Request $request)
	{	
		$validator = Validator::make($request->all(), [
			'location_id' => 'required|integer|not_in:0'
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor_id = Auth::user()->tutor->id;
		$locations_number = Tutor::find($tutor_id)->locations->count();
			
		if ($locations_number < 2) return response()->json(array('success' => 'NO', 200));	
		
		DB::table('locations')
			->where('id', $request->location_id)
			->where('tutor_id', $tutor_id)
			->delete();	
		
		return response()->json(array('success' => 'OK', 200)); 
	}
}

