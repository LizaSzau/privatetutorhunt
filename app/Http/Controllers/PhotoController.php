<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use App\Models\Photo;
use App\Models\Tutor;
use Auth;
use DB;


class PhotoController extends TutorController
{	

//------------------------------------------------------------------------------
// formImagesget - Select photos for editing
//------------------------------------------------------------------------------

	public function formImagesGET()
	{  
		$photo = new Photo;
		
		$data = array
		(
			'photos' => $photo->getPhotos()
		); 
		
		return response()->json(array('data' => $data, 200));
	}

//******************************************************************************
// Photos order or delete from given id array
//******************************************************************************

	public function photoOrderDeletePOST(Request $request)
	{	
		$data = $request->images_id;
		$post_id = explode(',', $data);

		if (count($post_id) > 0) {
			$tutor = DB::table('tutors')->where('user_id', Auth::id())->get();
			
			$photos_tutor = DB::table('photos')
				->select('id')
				->where('tutor_id', $tutor[0]->id)
				->get();
			
			$photos = new Photo();
			
			foreach($photos_tutor as $photo_tutor) {
				if (!in_array($photo_tutor->id, $post_id)) {
					$photos->deletePhoto($photo_tutor->id);
				}
			}
			
			$i = 1;
			
			foreach($post_id as $id) {
				$photos->setOrder($id, $i);
				$i++;
			}
		}
		
		return response()->json(array('success' => 'OK', 200)); 
	}
	
	
//******************************************************************************
// Upload photo when modify gallery
//******************************************************************************

	public function formPhotoUploadPOST(Request $request)
	{	
		$data = $request->all();

		$tutor = DB::table('tutors')->where('user_id', Auth::id())->get();
		$sort = DB::table('photos')->where('tutor_id', $tutor[0]->id)->count();
		
		foreach ($data as $key => $value) {
			if ($value->getMimeType() == 'image/jpeg') {
				$sort++;
				$photo = new Photo; 
				$photo->uploadPhoto($value, $sort);
			}
		}

		$tutor_ready = Tutor::find($tutor[0]->id)->tutorReady;
		$tutor_ready->media = 1;
		$tutor_ready->save();
		
		$this->checkProfileReady($tutor[0]->id);
		return response()->json(array('success' => 'OK', 200)); 
	}
}

