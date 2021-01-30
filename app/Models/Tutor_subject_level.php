<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Carbon\Carbon;

class Tutor_subject_level extends Model
{
    use HasFactory;
	protected $table = 'tutor_subject_level';
	
	private $subject_number;
	private $tutor_id;
	
//******************************************************************************
// Set tutor ID
//******************************************************************************

    public function __construct()
    {
		$tutor = User::find(Auth::id())->tutor;
		$this->tutor_id = $tutor->id;
    }
	
//------------------------------------------------------------------------------
// Get subjects number
//------------------------------------------------------------------------------

	public function getSubjectNumber()
    {
		$subject_number = DB::table($this->table)
			->select('id')
			->where('tutor_id', $this->tutor_id)
			->count();
	
		return $subject_number;
    }
	
//------------------------------------------------------------------------------
// Upload subject
//------------------------------------------------------------------------------

	public function uploadSubject($subject_id, $level_id)
    {
		DB::table($this->table)->insert([
			'tutor_id' => $this->tutor_id, 
			'subject_id' => $subject_id, 
			'level_id' => $level_id, 
			'created_at' => Carbon::parse(now()),
			'updated_at' => Carbon::parse(now())]
		);			
    }
	
//------------------------------------------------------------------------------
// Delete subject
//------------------------------------------------------------------------------

	public function deleteSubject($subject_id, $level_id)
    {
		$subject = DB::table($this->table)
			->where('tutor_id', $this->tutor_id)
			->where('subject_id', $subject_id)
			->where('level_id', $level_id)
			->delete();		
    }
}
