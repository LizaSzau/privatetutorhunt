<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tutor;
use View;
use Auth;

class LocationController extends Controller
{	

    public function __construct()
    {

    }

//------------------------------------------------------------------------------
// Select subjects for adding to profile
//------------------------------------------------------------------------------

	public function locationsGet()
	{  
		$tutor = User::find(Auth::id())->tutor;
		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		
		$data = array(
			'tutor_ready' => $tutor_ready,
		);
		
		return view('user.profile-locations')->with($data);
	}
}

