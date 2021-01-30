<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tmp_search;
use DB;
//use Str;

class SearchController extends Controller
{
	
//------------------------------------------------------------------------------
// categoriesListGET
//------------------------------------------------------------------------------

	
	public function categoriesListGET() {
		
		/*
		DB::table('tmp_search')->truncate();
		 
		$categories = DB::table('categories')
			->select('categories.id', 'categories.name', DB::raw('COUNT(subjects.id) AS pc'))
			->from('subject_tutor')
			->join('subjects', 'subjects.id', '=', 'subject_tutor.subject_id')
			->join('categories', 'categories.id', '=', 'subjects.category_id')
			->groupBy('categories.id', 'categories.name')
			->orderByDesc('categories.name')
			->get();
			
		
		foreach($categories as $cat) {

			$subjects = DB::table('subjects')
				->select('subjects.name AS name', 'subjects.id AS sub_id', 'categories.id', DB::raw('COUNT(subjects.id) AS pc'))
				->from('categories')
				->join('subjects', 'categories.id', '=', 'subjects.category_id')
				->join('subject_tutor', 'subjects.id', '=', 'subject_tutor.subject_id')
				->groupBy('subjects.name', 'subjects.id', 'categories.id')
				->having('categories.id', '=', $cat->id)
				->orderBy('subjects.name')
				->get();

			$string = '';	
			
			foreach($subjects as $sub) {
				$string .= $sub->name.'*'.$sub->pc.'*'.$sub->sub_id.';';
			}	
			
			$string = substr($string, 0, -1);
			
			$cat_name = Str::upper($cat->name);
			DB::insert('insert into tmp_search (category_id, category_name, subjects) values (?, ?, ?)', [$cat->id, $cat_name, $string]);
		}
		*/
		
		$data = DB::table('tmp_search')->get();
		return view('search.index', ['dataCategories' => $data]);
	}
}
