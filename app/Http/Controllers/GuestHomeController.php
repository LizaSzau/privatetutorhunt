<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use App\CreateViewTables;
use DB;

class GuestHomeController extends Controller
{  
	
//------------------------------------------------------------------------------
// categoriesListGET
//------------------------------------------------------------------------------

	public function categoriesListGET() {
		new CreateViewTables();
		
		$data = DB::table('tmp_home')->get();
		return view('home.main', ['dataCategories' => $data]);
	}
	
//------------------------------------------------------------------------------
// categoriesListHomeGET
//------------------------------------------------------------------------------

	public function categoriesListHomeGET() {
		new CreateViewTables();
		
		$data = DB::table('tmp_home')->get();
		return view('home.index', ['dataCategories' => $data]);
	}
}

