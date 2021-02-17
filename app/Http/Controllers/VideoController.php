<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use App\Models\Video;
use App\Models\Tutor;
use Auth;
use DB;


class VideoController extends Controller
{	

    public function __construct()
    {

    }

//------------------------------------------------------------------------------
// Select videos for editing
//------------------------------------------------------------------------------

	public function formVideosGET()
	{  
		$video = new Video;
		
		$data = array
		(
			'videos' => $video->getVideos()
		); 
			
		return response()->json(array('data' => $data, 200));
	}

//******************************************************************************
// Delete video
//******************************************************************************

	public function videoDeletePOST(Request $request)
	{	
		$data = $request->images_id;
		$post_id = explode(',', $data);

		$validator = Validator::make($request->all(), [
			'video_id' => 'required|min:1|max:100',
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}

		$tutor = DB::table('tutors')->where('user_id', Auth::id())->get();

		$video = new Video; 
		$id = $video->deleteVideo($request->video_id);
		
		return response()->json(array('success' => 'OK', 200)); 
	}	
	
//******************************************************************************
// Upload video 
//******************************************************************************

	public function formVideoUploadPOST(Request $request)
	{	
		$validator = Validator::make($request->all(), [
			'video_id' => 'required|min:1|max:100',
		]);

		if ($validator->fails()) {
			return response()->json(array('success' => 'NO', 200));	
		}

		$tutor = DB::table('tutors')->where('user_id', Auth::id())->get();
		$sort = DB::table('videos')->where('tutor_id', $tutor[0]->id)->count();

		$video = new Video; 
		$id = $video->uploadVideo($request->video_id, $sort);

		return response()->json(array('id' => $id, 200)); 
	}
}

