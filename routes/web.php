<?php

use App\Models\SessionModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
//use App\Http\Controllers\HomeController;
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
//Route::get('/', [HomeController::class, 'index']);
Route::get('/watch', [App\Http\Controllers\HomeController::class, 'watch']);
Route::any('/stream/{code}', [App\Http\Controllers\HomeController::class, 'stream']);

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/test', [App\Http\Controllers\TestController::class, 'test'])->name('test');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/save_message', [App\Http\Controllers\Admin\Cms\MessageController::class, 'save_message'])->name('save_message');
Route::get('/address/get_cities/{id}', [App\Http\Controllers\AddressController::class, 'get_cities'])->name('address_get_cities');
Route::get('/address/get_barangays/{id}', [App\Http\Controllers\AddressController::class, 'get_barangays'])->name('address_get_barangays');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

	Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin_dashboard');
	Route::get('/messages', [App\Http\Controllers\Admin\Cms\MessageController::class, 'index'])->name('admin_messages');
	Route::any('/students/search', [App\Http\Controllers\Admin\StudentController::class, 'search'])->name('admin_student_search');
	Route::get('/contents/team', [App\Http\Controllers\Admin\Cms\ContentController::class, 'team'])->name('admin_team');
	Route::get('/contents/about', [App\Http\Controllers\Admin\Cms\ContentController::class, 'about'])->name('admin_about');
	Route::get('/contents/contact', [App\Http\Controllers\Admin\Cms\ContentController::class, 'contact'])->name('admin_contact');
	Route::get('/contents/add_team', [App\Http\Controllers\Admin\Cms\ContentController::class, 'team_add'])->name('admin_team_add');
	Route::get('/contents/edit_team/{id}', [App\Http\Controllers\Admin\Cms\ContentController::class, 'team_edit'])->name('admin_team_edit');
	Route::post('/contents/save', [App\Http\Controllers\Admin\Cms\ContentController::class, 'save_content'])->name('admin_save_content');
	Route::get('/season/index', [App\Http\Controllers\Admin\SeasonController::class, 'index'])->name('admin_season_index');
	Route::get('/season/add', [App\Http\Controllers\Admin\SeasonController::class, 'add'])->name('admin_season_add');
	Route::get('/season/edit/{id}', [App\Http\Controllers\Admin\SeasonController::class, 'edit'])->name('admin_season_edit');
	Route::post('/season/save', [App\Http\Controllers\Admin\SeasonController::class, 'save'])->name('admin_season_save');
	Route::get('/batch/index/{id}', [App\Http\Controllers\Admin\BatchController::class, 'index'])->name('admin_batch_index');
	Route::get('/batch/add/{id}', [App\Http\Controllers\Admin\BatchController::class, 'add'])->name('admin_batch_add');
	Route::get('/batch/edit/{id}', [App\Http\Controllers\Admin\BatchController::class, 'edit'])->name('admin_batch_edit');
	Route::get('/batch/view/{batchid}/{courseid?}/{subjectid?}', [App\Http\Controllers\Admin\BatchController::class, 'view'])->name('admin_batch_view');
	Route::get('/batch/videos/{classid}', [App\Http\Controllers\Admin\BatchController::class, 'videos'])->name('admin_batch_videos');
	Route::get('/batch/videosv2/{classid}', [App\Http\Controllers\Admin\BatchController::class, 'videosv2'])->name('admin_batch_videosv2');
	Route::post('/batch/add_videos', [App\Http\Controllers\Admin\BatchController::class, 'add_videos'])->name('admin_batch_add_videos');
	Route::post('/batch/update_videos', [App\Http\Controllers\Admin\BatchController::class, 'update_videos'])->name('admin_batch_update_videos');
	Route::post('/batch/update_collection', [App\Http\Controllers\Admin\BatchController::class, 'update_collection'])->name('admin_batch_update_collection');
	Route::get('/batch/sync_videos/{classid}', [App\Http\Controllers\Admin\BatchController::class, 'syncClassVideos'])->name('batch_sync_videos');
	Route::get('/batch/sync_all_videos', [App\Http\Controllers\Admin\BatchController::class, 'syncAllClass'])->name('batch_sync_all_videos');
	Route::post('/batch/remove_videos', [App\Http\Controllers\Admin\BatchController::class, 'remove_videos'])->name('admin_batch_remove_videos');
	Route::post('/batch/save', [App\Http\Controllers\Admin\BatchController::class, 'save'])->name('admin_batch_save');
	Route::get('/gdrive/videos', [App\Http\Controllers\Admin\GDriveController::class, 'videos'])->name('admin_gdrive_videos');
	Route::post('/gdrive/import_videos', [App\Http\Controllers\Admin\GDriveController::class, 'import_videos'])->name('admin_gdrive_import_videos');
	Route::get('/course/index', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin_courses');
	Route::get('/course/add', [App\Http\Controllers\Admin\CourseController::class, 'add'])->name('admin_course_add');
	Route::get('/course/edit/{id}', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('admin_course_edit');
	Route::post('/course/save', [App\Http\Controllers\Admin\CourseController::class, 'save'])->name('admin_course_save');
	Route::get('/subject/add/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'add'])->name('admin_subject_add');
	Route::get('/subject/edit/{id}', [App\Http\Controllers\Admin\SubjectController::class, 'edit'])->name('admin_subject_edit');
	Route::post('/subject/save', [App\Http\Controllers\Admin\SubjectController::class, 'save'])->name('admin_subject_save');
	Route::get('/coach/index', [App\Http\Controllers\Admin\CoachController::class, 'index'])->name('admin_coaches');
	Route::get('/coach/add', [App\Http\Controllers\Admin\CoachController::class, 'add'])->name('admin_coach_add');
	Route::get('/coach/edit/{id}', [App\Http\Controllers\Admin\CoachController::class, 'edit'])->name('admin_coach_edit');
	Route::post('/coach/save', [App\Http\Controllers\Admin\CoachController::class, 'save'])->name('admin_coach_save');
	Route::post('/attachment/save_chunk', [App\Http\Controllers\Admin\AttachmentController::class, 'saveChunk'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
	Route::any('/attachment/streamAttachment/{id}', [App\Http\Controllers\Admin\AttachmentController::class, 'streamAttachment'])->name('admin_stream_mov');
	Route::post('/attachment/remove', [App\Http\Controllers\Admin\AttachmentController::class, 'remove'])->name('admin_attachm_remove');
	Route::post('/batch/save_class', [App\Http\Controllers\Admin\BatchController::class, 'save_class'])->name('admin_batch_save_class');
	Route::any('/batch/students/{batchid}', [App\Http\Controllers\Admin\BatchController::class, 'students'])->name('admin_batch_student');
	Route::post('/batch/search/{batchid}', [App\Http\Controllers\Admin\BatchController::class, 'students'])->name('admin_batch_student_search');
	Route::get('/users/index', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin_users');
	Route::get('/users/add', [App\Http\Controllers\Admin\UserController::class, 'add'])->name('admin_user_add');
	Route::get('/users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin_user_edit');
	Route::post('/users/save', [App\Http\Controllers\Admin\UserController::class, 'save'])->name('admin_user_save');
});
Route::prefix('student')->middleware(['auth', 'role:student', 'verified'])->group(function () {
	Route::get('/profile', [App\Http\Controllers\Student\ProfileController::class, 'index'])->name('student_profile');
	Route::get('/profile/edit', [App\Http\Controllers\Student\ProfileController::class, 'edit'])->name('student_profile_edit');
	Route::get('/profile/changep', [App\Http\Controllers\Student\ProfileController::class, 'changep'])->name('student_profile_changep');
	Route::post('/profile/save', [App\Http\Controllers\Student\ProfileController::class, 'save'])->name('student_profile_save');
	Route::post('/profile/savep', [App\Http\Controllers\Student\ProfileController::class, 'savep'])->name('student_profile_savep');
	Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index']);
	Route::get('/portal/show/{batchid}/{courseid?}/{subjectid?}', [App\Http\Controllers\Student\PortalController::class, 'show'])->name('student_portal_show');
	Route::get('/portal/showv2/{batchid}/{courseid?}/{subjectid?}', [App\Http\Controllers\Student\PortalController::class, 'showv2'])->name('student_portal_showv2');
	Route::get('/portal/showv3/{batchid}/{courseid?}/{subjectid?}', [App\Http\Controllers\Student\PortalController::class, 'showv3'])->name('student_portal_showv3');
	Route::post('/portal/join', [App\Http\Controllers\Student\PortalController::class, 'join'])->name('student_portal_join');
	Route::any('/attachment/stream/{code}', [App\Http\Controllers\Admin\AttachmentController::class, 'stream'])->name('student_stream_mov');

	Route::get('/live', function () {
		return view('student.portal.livefeed');
	})->name('live');
});

Route::get('/logout', function () {
	Session::flush();
	Auth::logout();
	return redirect('login');
});

Route::get('/verify-session', function () {
	//$validSession = !is_null(SessionModel::where('user_id', auth()->user()->id)->first());
	return response()->json(['isValidSession' => Auth::check()]);
});
