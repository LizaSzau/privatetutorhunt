<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorReady extends Model
{
    use HasFactory;
	
	protected $table = 'tutor_ready';
	
    protected $fillable = [
        'tutor_id'
    ];
	
    public function tutor()
    {
        return $this->belongsTo('App\Models\Tutor', 'tutor_id');
    }
}
