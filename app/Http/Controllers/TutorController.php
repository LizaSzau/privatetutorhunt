<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Photo;
use App\Models\Video;
use App\CreateViewTables;
use Auth;
use DB;

class TutorController extends Controller
{
	
//******************************************************************************
// welcometGET
//******************************************************************************

	public function welcomeGET() {
		$tutor_id = Auth::user()->tutor->id;
		$tutor_ready = Tutor::find($tutor_id)->tutorReady;

		$data = array(
			'tutor_ready' => $tutor_ready,
			'tutor_status' => Tutor::find($tutor_id)->flag_status
		);
		
		return view('user.profile-welcome')->with($data);
	}
	
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
			'tutor_ready' => $tutor_ready,
			'tutor_status' => Tutor::find($tutor[0]->id)->flag_status
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
			'tutor_ready' => $tutor_ready,
			'tutor_status' => Tutor::find($tutor[0]->id)->flag_status
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
			'tutor_status' => Tutor::find($tutor[0]->id)->flag_status,
			'image_number' => $image_number,
			'video_number' => $video_number
		);
			
		return view('user.profile-media')->with($data);
	}
	
//******************************************************************************
// formDetailsGET
//******************************************************************************

	public function formDetailGET() {
		$tutor = DB::table('tutors')
			->select('id', 'where_online', 'where_tutor_place', 'where_student_place', 'when_morning', 'when_afternoon', 'when_evening', 'when_weekend', 'fee', 'comment')
			->where('user_id', '=', Auth::id())
			->get();
			
		$tutor_ready = Tutor::find($tutor[0]->id)->tutorReady;
		
		$data = array(
			'tutor' => $tutor,
			'tutor_ready' => $tutor_ready,
			'tutor_status' => Tutor::find($tutor[0]->id)->flag_status
		);
			
		return view('user.profile-details')->with($data);
	}
	
//******************************************************************************
// formActivateGET
//******************************************************************************

	public function formActivateGET() {
		$tutor = DB::table('tutors')
			->select('id', 'name', 'email_visible', 'email_web', 'phone_area_1', 'phone_number_1', 'phone_area_2', 'phone_number_2', 'webpage', 'facebook')
			->where('user_id', '=', Auth::id())
			->get();
			
		$tutor_ready = Tutor::find($tutor[0]->id)->tutorReady;
		
		$data = array(
			'tutor_ready' => $tutor_ready,
			'tutor_status' => Tutor::find($tutor[0]->id)->flag_status
		);
			
		return view('user.profile-activate')->with($data);
	}
	
//******************************************************************************
// personalDataGET
//******************************************************************************

	public function personalDataGET() {
		return view('user.personal-data');
	}
	
//******************************************************************************
// formContactUploadPOST
//******************************************************************************

	public function formContactUploadPOST(Request $request) {
		
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
		
		$this->checkProfileReady($tutor->id);
		
		return response()->json(array('success' => 'OK', 200));	
	}
	
//******************************************************************************
// formAboutUploadPOST
//******************************************************************************

	public function formAboutUploadPOST(Request $request) {
		
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
		
		$this->checkProfileReady($tutor->id);
		
		return response()->json(array('success' => 'OK', 200));	
	}
	
//******************************************************************************
// formDetailsUploadPOST
//******************************************************************************

	public function formDetailsUploadPOST(Request $request) {
		$validator = Validator::make($request->all(), [
			'fee' => 'required|integer|digits_between:1,4'
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));		
		}
		
		// required_without_all -> dosn't work for me
		
		$ok = false;
		if ($request->where_online == 1) $ok = true;
		if ($request->where_student_place == 1) $ok = true;
		if ($request->where_tutor_place == 1) $ok = true;
		
		if (!$ok) {
			return response()->json(array('success' => 'NO', 200));		
		}
	
		$ok = false;
		if ($request->when_morning == 1) $ok = true;
		if ($request->when_afternoon == 1) $ok = true;
		if ($request->when_evening == 1) $ok = true;
		if ($request->when_weekend == 1) $ok = true;
		
		if (!$ok) {
			return response()->json(array('success' => 'NO', 200));		
		}
		
		$tutor = User::find(Auth::id())->tutor;
		$tutor->where_online = $request->where_online;
		$tutor->where_tutor_place = $request->where_tutor_place;
		$tutor->where_student_place = $request->where_student_place;
		$tutor->when_morning = $request->when_morning;
		$tutor->when_afternoon = $request->when_afternoon;
		$tutor->when_evening = $request->when_evening;
		$tutor->when_weekend = $request->when_weekend;
		$tutor->fee = $request->fee;
		$tutor->comment = $request->comment;
		$tutor->save();

		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		$tutor_ready->details = 1;
		$tutor_ready->save();
		
		$this->checkProfileReady($tutor->id);
		
		return response()->json(array('success' => 'OK', 200));	
	}
	
//******************************************************************************
// formActivateSET - when user click on activate / deactivate button
//******************************************************************************

	public function formActivateSET() {
		$tutor = Auth::user()->tutor;
		$flag_status = $tutor->flag_status;
		$flag = 2;
		
		if ($flag_status == 0 || $flag_status == 2) {  // deactivated or inactive after reg
			$flag = 1;
		} 
			
		$tutor->flag_status = $flag;
		$tutor->save();		
		
		new CreateViewTables();
		
		return redirect('/tutor/profile/activate');
	}
	
//******************************************************************************
// personalDataDeletePOST
//******************************************************************************

	public function personalDataDeletePOST(Request $request) {
		if ($request->delete != 'delete all of my data') {
			return redirect('/tutor/personal-data');	
		}
		
		$user_id = Auth::user()->id;
		$tutor_id = Auth::user()->tutor->id;
		$email = Auth::user()->email;
		
		$photos = DB::table('photos')->where('tutor_id', $tutor_id)->get();
		
		foreach ($photos as $photo) 
		{ 
			@unlink('upload/photos/large/'.$photo->name);
			@unlink('upload/photos/small/'.$photo->name);
		}
		
		DB::delete('DELETE FROM locations WHERE tutor_id = ?', [$tutor_id]);
		DB::delete('DELETE FROM new_subjects WHERE tutor_id = ?', [$tutor_id]);
		DB::delete('DELETE FROM password_resets WHERE email = ?', [$email]);
		DB::delete('DELETE FROM photos WHERE tutor_id = ?', [$tutor_id]);
		DB::delete('DELETE FROM tutors WHERE id = ?', [$tutor_id]);
		DB::delete('DELETE FROM tutor_ready WHERE tutor_id = ?', [$tutor_id]);
		DB::delete('DELETE FROM tutor_subject_level WHERE tutor_id = ?', [$tutor_id]);
		DB::delete('DELETE FROM verify_users WHERE id_user = ?', [$user_id]);
		DB::delete('DELETE FROM videos WHERE tutor_id = ?', [$tutor_id]);
		
		new CreateViewTables();
		
		DB::delete('DELETE FROM users WHERE id = ?', [$user_id]);
		return redirect('/');
	}
	
//******************************************************************************
// Check tutor profile ready
//******************************************************************************

	protected function checkProfileReady($tutor_id) {
		$ready = true;
		$tutor_ready = Tutor::find($tutor_id)->tutorReady;
		
		if ($tutor_ready->contact == 0) $ready = false;
		if ($tutor_ready->about == 0) $ready = false;
		if ($tutor_ready->media == 0) $ready = false;
		if ($tutor_ready->subjects == 0) $ready = false;
		if ($tutor_ready->location == 0) $ready = false;
		if ($tutor_ready->details == 0) $ready = false;
		
		if ($ready) {
			$tutor_ready->flag_ready = 1;
		} else {
			$tutor_ready->flag_ready = 0;
		}
		
		$tutor_ready->save();
	}
}
