<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use View;
use App\Models\User;
use App\Models\Tutor;
use App\Models\NewSubject;
use App\Models\TutorSubjectLevel;
use App\Models\Tmp_home;
use App\Mail\NewSubjectMail;
use App\CreateViewTables;
use Auth;
use DB;
use Str;

class SubjectController extends Controller
{	
	private $maxNewSubjects = 3;
	
    public function __construct()
    {

    }

//------------------------------------------------------------------------------
// Select subjects for adding to profile
//------------------------------------------------------------------------------

	public function subjectsGet()
	{  
		$tutor = User::find(Auth::id())->tutor;
		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		 
		$categories = DB::table('categories')
			->select('id', 'name')
			->orderBy('categories.name', 'asc')
			->get();
			
		
		foreach($categories as $cat) {
			$subjects = DB::table('subjects')
				->select('id', 'name')
				->where('category_id', '=', $cat->id)
				->orderBy('name', 'asc')
				->get();
				
			$cat->subjects = $subjects;
		}
		
		$levels = DB::table('levels')
			->select('id', 'level')
			->get();
			
		$tutor_subject_level = new TutorSubjectLevel();
		$subject_number = $tutor_subject_level->getSubjectNumber();
			
		$subjects = DB::table('tutor_subject_level')
			->select('tutor_subject_level.subject_id AS subject_id', 'name', 'level', 'levels.id AS level_id')
			->join('subjects', 'subjects.id', '=', 'tutor_subject_level.subject_id')
			->join('levels', 'levels.id', '=', 'tutor_subject_level.level_id')
			->where('tutor_id', '=', $tutor->id)
			->orderBy('name', 'asc')
			->get();	

		$new_subjects = DB::table('new_subjects')
			->select('name')
			->where('tutor_id', '=', $tutor->id)
			->where('flag', '=', 1)
			->orderBy('name')
			->get();
			
		$data = array(
			'levels' => $levels,
			'categories' => $categories,
			'subjects' => $subjects,
			'subject_number' => $subject_number,
			'tutor_ready' => $tutor_ready,
			'new_subjects' => $new_subjects
		);
		
		return view('user.profile-subjects')->with($data);
	}
	
//******************************************************************************
// Upload subject and level
//******************************************************************************

	public function formSubjectUploadPOST(Request $request)
	{	
		$validator = Validator::make($request->all(), [
			'select_subject' => 'required|integer|not_in:0',
			'select_level' => 'required|integer|not_in:0'
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor = User::find(Auth::id())->tutor;
		
		$subjects = DB::table('tutor_subject_level')
			->select('id')
			->where('tutor_id', '=', $tutor->id)
			->where('subject_id', '=', $request->select_subject)
			->where('level_id', '=', $request->select_level)
			->get()
			->count();
			
		if ($subjects != 0) return response()->json(array('success' => 'NO', 200));	
		
		$tutor_subject_level = new TutorSubjectLevel;
		$tutor_subject_level->uploadSubject($request->select_subject, $request->select_level);
		
		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		$tutor_ready->subjects = 1;
		$tutor_ready->save();
		
		new CreateViewTables();
		
		return response()->json(array('success' => 'OK', 200)); 
	}
	
//******************************************************************************
// Delete subject and level
//******************************************************************************

	public function formSubjectDeletePOST(Request $request)
	{	
		$validator = Validator::make($request->all(), [
			'subject_id' => 'required|integer|not_in:0',
			'level_id' => 'required|integer|not_in:0'
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor = User::find(Auth::id())->tutor;
		
		$subjects = DB::table('tutor_subject_level')
			->select('id')
			->where('tutor_id', '=', $tutor->id)
			->get()
			->count();
			
		if ($subjects < 2) return response()->json(array('success' => 'NO', 200));	
		
		$tutor_subject_level = new TutorSubjectLevel;
		$tutor_subject_level->deleteSubject($request->subject_id, $request->level_id);
		
		new CreateViewTables();
		
		return response()->json(array('success' => 'OK', 200)); 
	}
	
//******************************************************************************
// Post missing subjects
//******************************************************************************

	public function formSubjectMissingPOST(Request $request)
	{	
		$validator = Validator::make($request->all(), [
			'subject' => 'required|string'
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}
		
		$tutor = User::find(Auth::id())->tutor;
		
		$subjects = DB::table('new_subjects')
			->select('id')
			->where('tutor_id', '=', $tutor->id)
			->where('flag', '=', 1)
			->get()
			->count();
			
		if ($subjects >= $this->maxNewSubjects) return response()->json(array('success' => 'NO', 200));	
		
		$new_subject = new NewSubject;
		$new_subject->tutor_id = $tutor->id;
		$new_subject->name = $request->subject;
		$new_subject->save();
		
		$this->sendMail($tutor->id, $request->subject);
		return response()->json(array('success' => 'OK', 200)); 
	}
	
//------------------------------------------------------------------------------
// Send email with new subjects
//------------------------------------------------------------------------------

	private function sendMail($tutorID, $newSubject)
	{ 	
        $mail = new \stdClass();
        $mail->tutorID = $tutorID;
        $mail->newSubject = $newSubject;
   
		Mail::to(config('app.email'))->send(new NewSubjectMail($mail));
	}
}

