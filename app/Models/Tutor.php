<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];
	
    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject');
    }
	
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }			
	
    public function tutorReady()
    {
        return $this->hasOne('App\Models\TutorReady');
    }
}
