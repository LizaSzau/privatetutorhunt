<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Auth;
use Carbon\Carbon;

class Video extends Model
{
	protected $fillable = [
        'tutor_id'
    ];
	
	protected $table = 'videos';
	private $tutor_id;
	private $video_number = 2;
	
//******************************************************************************
// Set tutor ID
//******************************************************************************

    public function __construct()
    {
		$tutor = User::find(Auth::id())->tutor;
		$this->tutor_id = $tutor->id;
    }
	
//------------------------------------------------------------------------------
// One to many relation between property and photos table
//------------------------------------------------------------------------------

	public function tutor()
    {
       return $this->belongsTo('App\Models\Tutor');
    }
	
//------------------------------------------------------------------------------
// Get Videos
//------------------------------------------------------------------------------

	public function getVideos()
    {
		$videos = DB::table($this->table)
			->select('id', 'name')
			->where('tutor_id', $this->tutor_id)
			->get();
			
		return $videos;
    }

//------------------------------------------------------------------------------
// Get video number
//------------------------------------------------------------------------------

	public function getVideoNumber()
    {
		$videos = DB::table($this->table)
			->select('id')
			->where('tutor_id', $this->tutor_id)
			->count();
	
		return $videos;
    }
	
//------------------------------------------------------------------------------
// Delete video
//------------------------------------------------------------------------------

	public function deleteVideo($id)
    {		
		$videos = DB::table($this->table)->where('id', $id)->where('tutor_id', $id)->get();
		$video = Video::find($id);
		$video->delete();
    }
	
//------------------------------------------------------------------------------
// Upload videos
//------------------------------------------------------------------------------

	public function uploadVideo($name, $sort)
    {	
		if ($sort < $this->video_number)
		{
			DB::table('videos')->insert([
				'name' => $name, 
				'tutor_id' => $this->tutor_id, 
				'created_at' => Carbon::parse(now()),
				'updated_at' => Carbon::parse(now())]
			);
		}
	
		return DB::getPdo()->lastInsertId();
    }

}
