<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('gattachments', [App\Http\Controllers\Admin\SeasonController::class, 'get_attachments'])->name('get_attachments');
Route::any('sattachments', [App\Http\Controllers\Admin\SeasonController::class, 'save_attachments'])->name('save_attachments');

Route::any('callback/update', [App\Http\Controllers\Api\CallbackController::class, 'update'])->name('callback.update');
Route::any('videos/sync', [App\Http\Controllers\Api\CallbackController::class, 'syncClassCollections'])->name('callback.sync');

