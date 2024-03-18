<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MeetingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ZoomController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LogoutController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::post('/logout', LogoutController::class)->middleware('auth:sanctum')->name('logout');

Route::controller(MeetingController::class)->group(function (){
    Route::get('meetings', 'index');
    Route::get('/countries','getCountries');
});

Route::controller(MeetingController::class)->middleware(['api', 'auth:sanctum'])->group(function() {
    Route::prefix('meetings')->group(function() {
        Route::get('/export', 'export');
        Route::get('/export/members/{id}','exportMembers');
        Route::get('/filter','filterMeetings');
        Route::get('/search', 'search');
    });
    Route::post('join/{id}', 'join')->name('join');
    Route::post('cancel/{id}', 'cancel')->name('cancel');
    Route::resource('meetings', MeetingController::class)->only(['show','create','store','update','destroy']);
});

Route::controller(LectureController::class)->middleware('auth:sanctum')->group(function (){
    Route::prefix('lectures')->group(function (){
        Route::get('/filter','filterLectures');
        Route::get('/search', 'search');
        Route::get('/export/{id}', 'export');
        Route::get('/download/{presentation}','download');
    });
    Route::get('/meetings/lectures/{id}', 'showByMeeting');
    Route::get('/meetings/slots/{id}', 'getSlots');
    Route::get('/meeting/{id}/lecture/', 'showByMeetingUser');
    Route::resource('lectures', LectureController::class);
});

Route::controller(CommentController::class)->middleware('auth:sanctum')->group(function(){
    Route::resource('comments', CommentController::class);
    Route::get('/comments/export/{id}', 'export');
});

Route::controller(UserController::class)->group(function () {
    Route::put('/profile','update')->middleware('auth:sanctum');
});

Route::controller(FavoriteController::class)->middleware('auth:sanctum')->prefix('favorites')->group(function (){
    Route::post('/add/{id}', 'add');
    Route::delete('/delete/{id}', 'delete');
    Route::get('/', 'show');
});

Route::controller(CategoryController::class)->middleware('auth:sanctum')->group(function (){
    Route::post('/category','add');
    Route::put('/category/{id}','update');
    Route::get('/categories/list','getCategoryList');
    Route::get('/categories','getCategories');
    Route::post('/category/delete', 'deleteCategory');
});

Route::controller(ZoomController::class)->middleware('auth:sanctum')->prefix('zoom')->group(function (){
    Route::get('/list','list');
    Route::post('/','create');
    Route::put('/{id}','update');
    Route::get('/{id}','get');
    Route::delete('/{id}','delete');
});

Route::controller(PlanController::class)->prefix('plan')->middleware('auth:sanctum')->group(function (){
   Route::get('/cancel','cancel');
   Route::get('/list','showAll');
   Route::get('/current','userPlan');
   Route::get('/{id}','show');
   Route::post('/subscribe', 'subscribe');
});
