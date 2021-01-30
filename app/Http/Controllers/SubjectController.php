<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Tutor_subject_level;
use Auth;
use DB;


class SubjectController extends Controller
{	

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
			
		$tutor_subject_level = new Tutor_subject_level();
		$subject_number = $tutor_subject_level->getSubjectNumber();
			
		$subjects = DB::table('tutor_subject_level')
			->select('tutor_subject_level.subject_id AS subject_id', 'name', 'level', 'levels.id AS level_id')
			->join('subjects', 'subjects.id', '=', 'tutor_subject_level.subject_id')
			->join('levels', 'levels.id', '=', 'tutor_subject_level.level_id')
			->where('tutor_id', '=', $tutor->id)
			->orderBy('name', 'asc')
			->get();	

		$data = array(
			'levels' => $levels,
			'categories' => $categories,
			'subjects' => $subjects,
			'subject_number' => $subject_number,
			'tutor_ready' => $tutor_ready
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
		
		$tutor_subject_level = new Tutor_subject_level;
		$tutor_subject_level->uploadSubject($request->select_subject, $request->select_level);
		
		$tutor_ready = Tutor::find($tutor->id)->tutorReady;
		$tutor_ready->subjects = 1;
		$tutor_ready->save();
		
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
		
		$tutor_subject_level = new Tutor_subject_level;
		$tutor_subject_level->deleteSubject($request->subject_id, $request->level_id);
		
		return response()->json(array('success' => 'OK', 200)); 
	}
}

