<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestHomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TutorsListController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [GuestHomeController::class, 'categoriesListGET']);
Route::get('home', [GuestHomeController::class, 'categoriesListHomeGET'])->name('guest_home');
Route::get('subjects', [SearchController::class, 'categoriesListGET'])->name('search');

Route::get('for-tutors-and-teachers', function() { return view('/info/tutors'); });
Route::get('terms-of-service', function() { return view('/info/terms'); });
Route::get('privacy-policy', function() { return view('/info/privacy'); });
Route::get('contact', function() { return view('/info/contact'); });

// Auth users and registration

Auth::routes();

Route::get('auth/social', [LoginController::class, 'showLoginForm'])->name('social.login');
Route::get('oauth/{driver}', [LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

Route::get('successfully-registered', function() { return view('/auth/successfully_registered'); });
Route::get('registration/verify-email/{token}', [RegisterController::class, 'verifyUser']);
Route::get('registration/verify-email-failed', function() { return view('/auth/verify-email-failed'); });

Route::get('subjects/{category}', [TutorsListController::class, 'tutorsList']);

//------------------------------------------------------------------------------
// Registered user
//------------------------------------------------------------------------------

Route::group(['middleware' => ['auth']], function() 
{
	Route::get('tutor/dashboard', function() { return view('/user/dashboard'); })->name('user_home');
	Route::get('tutor/profile/welcome', [TutorController::class, 'welcomeGET']);
	Route::get('tutor/profile/contact', [TutorController::class, 'formContactGET']);
	Route::get('tutor/profile/about', [TutorController::class, 'formAboutGET']);
	Route::get('tutor/profile/media', [TutorController::class, 'formMediaGET']);
	Route::get('tutor/profile/images', [PhotoController::class, 'formImagesGET']);
	Route::get('tutor/profile/videos', [VideoController::class, 'formVideosGET']);
	Route::get('tutor/profile/subjects', [SubjectController::class, 'formSubjectsGET']);
	Route::get('tutor/profile/locations', [LocationController::class, 'formLocationGET']);
	Route::get('tutor/profile/details', [TutorController::class, 'formDetailGET']);
	Route::get('tutor/profile/activate', [TutorController::class, 'formActivateGET']);
	Route::get('tutor/profile/activate/set', [TutorController::class, 'formActivateSET']);
	Route::get('tutor/personal-data', [TutorController::class, 'personalDataGET']);
	
	Route::post('tutor/profile/form/contact/upload', [TutorController::class, 'formContactUploadPOST']);
	Route::post('tutor/profile/form/about/upload', [TutorController::class, 'formAboutUploadPOST']);
	Route::post('tutor/profile/form/media/photo/upload', [PhotoController::class, 'formPhotoUploadPOST']);
	Route::post('tutor/profile/form/media/photo/order-delete', [PhotoController::class, 'photoOrderDeletePOST']);
	Route::post('tutor/profile/form/media/video/upload', [VideoController::class, 'formVideoUploadPOST']);
	Route::post('tutor/profile/form/media/video/delete', [VideoController::class, 'videoDeletePOST']);
	Route::post('tutor/profile/form/subjects/upload', [SubjectController::class, 'formSubjectUploadPOST']);
	Route::post('tutor/profile/form/subjects/delete', [SubjectController::class, 'formSubjectDeletePOST']);
	Route::post('tutor/profile/form/subjects/missing', [SubjectController::class, 'formSubjectMissingPOST']);
	Route::post('tutor/profile/form/locations/upload', [LocationController::class, 'formLocationUploadPOST']);
	Route::post('tutor/profile/form/locations/delete', [LocationController::class, 'formLocationDeletePOST']);
	Route::post('tutor/profile/form/details/upload', [TutorController::class, 'formDetailsUploadPOST']);
	Route::post('tutor/personal-data/delete', [TutorController::class, 'personalDataDeletePOST']);
});
