<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
	
//------------------------------------------------------------------------------
// categoriesListGET
//------------------------------------------------------------------------------

	public function categoriesListGET() {
		$data = DB::table('tmp_subjects')->get();
		return view('search.index', ['dataCategories' => $data]);
	}
}
