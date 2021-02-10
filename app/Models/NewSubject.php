<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Carbon\Carbon;

class NewSubject extends Model
{
	use HasFactory;
	protected $table = 'new_subjects';
}
