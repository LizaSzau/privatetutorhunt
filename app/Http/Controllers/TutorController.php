<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Photo;
use App\Models\Video;
use Auth;
use DB;

class TutorController extends Controller
{
	
//******************************************************************************
// formContactGET
//******************************************************************************

	public function formContactGET() {
		//$tutor = User::find(Auth::id())->tutor->select('tutor.name');
		
		$tutor = DB::table('tutors')
			->select('id', 'name', 'email_visible', 'email_web', 'phone_area_1', 'phone_number_1', 'phone_area_2', 'phone_number_2', 'webpage', 'facebook')
			->where('user_id', '=', Auth::id())
			->get();
			
		$tutor_ready = Tutor::find($tutor[0]->id)->tutorReady;
		
		$data = array(
			'tutor' => $tutor,
			'tutor_ready' => $tutor_ready
		);
			
		return view('user.profile-contact')->with($data);
	}
		
//******************************************************************************
// formAboutGET
//******************************************************************************

	public function formAboutGET() {
		$tutor = DB::table('tutors')
			->select('id', 'title', 'about_you', 'about_education', 'about_experience')
			->where('user_id', '=', Auth::id())
			->get();
			
		$tutor_ready = Tutor::find($tutor[0]->id)->tutorReady;
		
		$data = array(
			'tutor' => $tutor,
			'tutor_ready' => $tutor_ready
		);
			
		return view('user.profile-about')->with($data);
	}
	
//******************************************************************************
// formMediaGET
//******************************************************************************

	public function formMediaGET() {
			
		$tutor = DB::table('tutors')
			->select('id')
			->where('user_id', '=', Auth::id())
			->get();
			
		$tutor_ready = Tutor::find($tutor[0]->id)->tutorReady;
		
		$photo = new Photo();
		$image_number = $photo->getImageNumber();
		
		$video = new Video();
		$video_number = $video->getVideoNumber();
		
		$data = array(
			'tutor_ready' => $tutor_ready,
			'image_number' => $image_number,
			'video_number' => $video_number
		);
			
		return view('user.profile-media')->with($data);
	}
	
//******************************************************************************
// formContactPOST
//******************************************************************************

	public function formContactPOST(Request $request) {
		
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:5|max:191',
			'phone_area_1' => 'nullable|min:2|max:5',
			'phone_area_1' => 'required_with: phone_number_1',
			'phone_number_1' => 'nullable|min:4|max:8',
			'phone_number_1' => 'required_with: phone_area_1',
			'phone_area_2' => 'nullable|min:2|max:5',
			'phone_area_2' => 'required_with: phone_number_2',
			'phone_number_2' => 'nullable|min:4|max:8',
			'phone_number_2' => 'required_with: phone_area_2',
			'webpage' => 'nullable|url'
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		if (!$request->phone_area_1 && !$request->phone_area_2 && !$request->email_visible && !$request->email_web) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor = User::find(Auth::id())->tutor;
		$tutor->name = $request->name;
		if ($request->email_visible) $tutor->email_visible = 1; else $tutor->email_visible = 0;
		if ($request->email_web) $tutor->email_web = 1; else $tutor->email_web = 0;
		$tutor->phone_area_1 = $request->phone_area_1;
		$tutor->phone_number_1 = $request->phone_number_1;
		$tutor->phone_area_2 = $request->phone_area_2;
		$tutor->phone_number_2 = $request->phone_number_2;
		$tutor->webpage = $request->webpage;
		$tutor->facebook = $request->facebook;
		$tutor->save();

		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		$tutor_ready->contact = 1;
		$tutor_ready->save();
		
		return response()->json(array('success' => 'OK', 200));	
	}
	
//******************************************************************************
// formAboutPOST
//******************************************************************************

	public function formAboutPOST(Request $request) {
		
		$validator = Validator::make($request->all(), [
			'title' => 'required|min:20|max:100',
			'about' => 'required|min:100|max:5000',
			'education' => 'required|min:50|max:2000',
			'experience' => 'required|min:50|max:5000',
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor = User::find(Auth::id())->tutor;
		$tutor->title = $request->title;
		$tutor->about_you = $request->about;
		$tutor->about_education= $request->education;
		$tutor->about_experience= $request->experience;
		$tutor->save();

		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		$tutor_ready->about = 1;
		$tutor_ready->save();
		
		return response()->json(array('success' => 'OK', 200));	
	}
	
}