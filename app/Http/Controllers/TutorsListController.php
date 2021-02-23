<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TutorsListController extends Controller
{
	
//------------------------------------------------------------------------------
// List categories' tutors
//------------------------------------------------------------------------------

	public function tutorsList() {
		return view('category.index');
	}
}
