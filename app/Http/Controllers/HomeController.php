<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use App\Models\Tmp_home;
use DB;
// use Str;

class HomeController extends Controller
{  
	
//------------------------------------------------------------------------------
// categoriesListGET
//------------------------------------------------------------------------------

	public function categoriesListGET() {
		/*
		DB::table('tmp_home')->truncate();
		 
		$categories = DB::table('categories')
			->select('categories.id', 'categories.name', DB::raw('COUNT(subjects.id) AS pc'))
			->from('subject_tutor')
			->leftJoin('subjects', 'subjects.id', '=', 'subject_tutor.subject_id')
			->rightJoin('categories', 'categories.id', '=', 'subjects.category_id')
			->groupBy('categories.id', 'categories.name')
			->orderByDesc('pc')
			->get();
		
		foreach($categories as $cat) {

			$subjects = DB::table('subjects')
				->select('subjects.name AS name', 'categories.id', DB::raw('COUNT(subjects.id) AS pc'))
				->from('categories')
				->join('subjects', 'categories.id', '=', 'subjects.category_id')
				->join('subject_tutor', 'subjects.id', '=', 'subject_tutor.subject_id')
				->groupBy('subjects.name', 'categories.id')
				->having('categories.id', '=', $cat->id)
				->orderByDesc('pc')
				->limit(3)
				->get();

			$string = '';	
			
			if ($cat->pc > 0) {
				foreach($subjects as $sub) {
					$string .= '<h3>'.$sub->name.'</h3>';
				}	
			}
			
			$cat_name = Str::upper($cat->name);
			$slug = Str::slug($cat->name);
			DB::insert('insert into tmp_home (category_id, category_name, slug, subjects) values (?, ?, ?, ?)', [$cat->id, $cat_name, $slug, $string]);
		}
		*/
		$data = DB::table('tmp_home')->get();
		return view('home.index', ['dataCategories' => $data]);
	}
}

