<?php

namespace App;
use DB;
use Str;

class CreateViewTables
{
    public function __construct() {
		$this->createViewActiveTutorSubjectLevel();
        $this->createViewSubjectTutor();
        $this->createViewCategoryTutor();
        $this->createTmpHome();
        $this->createTmpSubjects();
    }
	
//******************************************************************************
// Generate view table - ActiveTutorSubjectlevel
//******************************************************************************

	private function createViewActiveTutorSubjectLevel() {
		DB::statement('DROP VIEW IF EXISTS view_active_tutor_subject_level');
		DB::statement('
			CREATE VIEW view_active_tutor_subject_level
            AS
			SELECT t.id, t.flag_status, tsl.tutor_id, tsl.subject_id 
			FROM tutor_subject_level AS tsl
			JOIN tutors AS t ON tsl.tutor_id = t.id
			HAVING t.flag_status = 1
		');
	}
	
//******************************************************************************
// Generate view table - SubjectTutor
//******************************************************************************

	private function createViewSubjectTutor() {
		DB::statement('DROP VIEW IF EXISTS view_subject_tutor');
		DB::statement('
			CREATE VIEW view_subject_tutor 
            AS
			SELECT s.id AS subject_id, s.name AS subject_name, c.id AS category_id, c.name AS category_name, COUNT(DISTINCT(tsl.tutor_id)) AS tutor_pc
			FROM view_active_tutor_subject_level AS tsl
			JOIN subjects AS s ON tsl.subject_id = s.id
			JOIN categories AS c ON s.category_id = c.id
			GROUP BY s.id  
			ORDER BY c.name, tutor_pc DESC
		');
	}
	
//******************************************************************************
// Generate view table - CategoryTutor
//******************************************************************************

	private function createViewCategoryTutor() {
		DB::statement('DROP VIEW IF EXISTS view_category_tutor');
		DB::statement('
			CREATE VIEW view_category_tutor 
            AS
			SELECT c.name, c.id, SUM(st.tutor_pc) AS tutor_pc
			FROM view_subject_tutor AS st
			RIGHT JOIN categories AS c ON c.id = st.category_id
			GROUP BY c.id
			ORDER BY tutor_pc DESC, c.name
		');
	}
	
//******************************************************************************
// Generate temp table - Home
//******************************************************************************

	private function createTmpHome()
	{
		$categories = DB::table('view_category_tutor')->get();
			
		DB::table('tmp_home')->truncate();
		
		foreach($categories as $cat) {

			$subjects = DB::table('view_subject_tutor')
				->select('subject_name', 'tutor_pc')
				->where('category_id', '=', $cat->id)
				->orderByDesc('tutor_pc')
				->limit(3)
				->get();

			$string = '';	
			
			if ($cat->tutor_pc > 0) {
				foreach($subjects as $sub) {
					$string .= '<h3>'.$sub->subject_name.'</h3>';
				}	
			}
			
			$cat_name = Str::upper($cat->name);
			$slug = Str::slug($cat->name);
			DB::insert('insert into tmp_home (category_id, category_name, slug, subjects) values (?, ?, ?, ?)', [$cat->id, $cat_name, $slug, $string]);
		}	
	}
	
//******************************************************************************
// Generate temp table - Subjects
//******************************************************************************

	private function createTmpSubjects()
	{
		$categories = DB::table('view_category_tutor')->get();
		
		DB::table('tmp_subjects')->truncate();
		
		foreach($categories as $cat) {

			$subjects = DB::table('view_subject_tutor')
				->select('subject_name', 'tutor_pc', 'subject_id')
				->where('category_id', '=', $cat->id)
				->orderByDesc('tutor_pc')
				->limit(3)
				->get();

			$string = '';	
			
			if ($cat->tutor_pc > 0) {
				foreach($subjects as $sub) {
					$string .= $sub->subject_name.'*'.$sub->tutor_pc.'*'.$sub->subject_id.';';
				}	
			
				$string = substr($string, 0, -1);
			
				$cat_name = Str::upper($cat->name);
				DB::insert('insert into tmp_subjects (category_id, category_name, subjects) values (?, ?, ?)', [$cat->id, $cat_name, $string]);
			}
		}	
	}
}