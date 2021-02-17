<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Location extends Model
{
    use HasFactory;
	
    protected $fillable = [
        'tutor_id'
    ];

	private $tutor_id;
	private $location_number = 3;
	
//******************************************************************************
// Set tutor ID
//******************************************************************************

    public function __construct()
    {
		$tutor = User::find(Auth::id())->tutor;
		$this->tutor_id = $tutor->id;
    }
	
//------------------------------------------------------------------------------
// One to many relation between tutors and locations table
//------------------------------------------------------------------------------

    public function tutor()
    {
        return $this->belongsTo('App\Models\Tutor', 'tutor_id');
    }
}
