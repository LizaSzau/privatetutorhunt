<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tutor;
use View;
use Auth;
use DB;

class LocationController extends Controller
{	

    public function __construct()
    {

    }

//------------------------------------------------------------------------------
// Location GET
//------------------------------------------------------------------------------

	public function locationGet()
	{  
		$tutor = DB::table('tutors')
			->select('id', 'address', 'lat', 'lng')
			->where('user_id', '=', Auth::id())
			->get();
			
		$tutor_ready = Tutor::find($tutor[0]->id)->tutorReady;
		
		$data = array(
			'tutor_ready' => $tutor_ready,
			'tutor' => $tutor
		);
		
		return view('user.profile-location')->with($data);
	}
	
//******************************************************************************
// formLocationPOST
//******************************************************************************

	public function formLocationPOST(Request $request) {
		
		$validator = Validator::make($request->all(), [
			'address' => 'required|max:50',
			'lat' => 'required|numeric|between:-90,90',
			'lng' => 'required|numeric|between:-180,180',
		]);
		
		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor = User::find(Auth::id())->tutor;
		$tutor->address = $request->address;
		$tutor->lat = $request->lat;
		$tutor->lng = $request->lng;
		$tutor->save();

		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		$tutor_ready->location = 1;
		$tutor_ready->save();
		
		return response()->json(array('success' => 'OK', 200));	
	}
}

