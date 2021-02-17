<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Auth;
use Carbon\Carbon;

class Photo extends Model
{
	protected $fillable = [
        'tutor_id'
    ];
	
	protected $table = 'photos';
	protected $tutor_id;
	private $image_large = 1024;
	private $image_small = 200;
	private $image_number = 5;
	
//******************************************************************************
// Set tutor ID
//******************************************************************************

    public function __construct()
    {
		$tutor = User::find(Auth::id())->tutor;
		$this->tutor_id = $tutor->id;
    }
	
//------------------------------------------------------------------------------
// One to many relation between tutors and photos table
//------------------------------------------------------------------------------

	public function tutor()
    {
       return $this->belongsTo('App\Models\Tutor');
    }
	
//------------------------------------------------------------------------------
// Get photos
//------------------------------------------------------------------------------

	public function getPhotos()
    {
		$photos = DB::table($this->table)
			->select('id', 'name')
			->where('tutor_id', $this->tutor_id)
			->orderBy('sort')
			->get();
			
		return $photos;
    }
	
//------------------------------------------------------------------------------
// Get image number
//------------------------------------------------------------------------------

	public function getImageNumber()
    {
		$photos = DB::table($this->table)
			->select('id')
			->where('tutor_id', $this->tutor_id)
			->count();
	
		return $photos;
    }
	
//------------------------------------------------------------------------------
// Delete one photo
//------------------------------------------------------------------------------

	public function deletePhoto($id)
    {		
		$photos = DB::table($this->table)->where('id', $id)->get();

		foreach ($photos as $photo) 
		{ 
			@unlink('upload/photos/large/'.$photo->name);		
			@unlink('upload/photos/small/'.$photo->name);		
		}
		
		$photos = Photo::find($id);
		$photos->delete();
    }

//------------------------------------------------------------------------------
// Set order photos
//------------------------------------------------------------------------------

	public function setOrder($id, $sort)
    {
		DB::table($this->table)
			->where('id', $id)
			->update(['sort' => $sort]);	
    }
	
//------------------------------------------------------------------------------
// Upload photos
//------------------------------------------------------------------------------

	public function uploadPhoto($file_pathname, $sort)
    {	
		if ($sort <= $this->image_number)
		{
			$file_name = $this->tutor_id.'_'.rand(1000000, 9999999).$sort;
			$file_name = $file_name.'.jpg';
		
			//file_put_contents('upload/big/'.$file, $data);	
		
			$photo = imagecreatefromjpeg($file_pathname);
			$photo_x = imagesx($photo);
			
			if ($photo_x > $this->image_large)
			{
				$photo = imagescale($photo, $this->image_large);
			}
			
			ImageJPEG($photo, 'upload/photos/large/'.$file_name, 60); 	

			// resize - small
			$photo = imagecreatefromjpeg($file_pathname);
			$photo_x = imagesx($photo);
			
			if ($photo_x > $this->image_small)
			{
				$photo = imagescale($photo, $this->image_small);
			}
			
			ImageJPEG($photo, 'upload/photos/small/'.$file_name, 60); 
			
			DB::table('photos')->insert([
				'name' => $file_name, 
				'tutor_id' => $this->tutor_id, 
				'sort' => $sort,
				'created_at' => Carbon::parse(now()),
				'updated_at' => Carbon::parse(now())]
			);
		}
	
		return true;
    }
	
//------------------------------------------------------------------------------
// Sort photos
//------------------------------------------------------------------------------

	public function sort_photos($sortArray)
    {
		$i = 1;
		
		foreach ($sortArray as $id) 
		{
			DB::table($this->table)
				->where('id', $id)
				->where('tutor_id', $this->tutor_id)
				->update(['sort' => $i]);	
				
			$i++;			
		}
	}
}
