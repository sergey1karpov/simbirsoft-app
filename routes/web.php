<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Show confirm message
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

/*
|--------------------------------------------------------------------------
| Confirm email route
|--------------------------------------------------------------------------
*/
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request, $id) {
    $request->fulfill();

    $user = User::find($id);
    $user->status = 'Active';
    $user->update();

    return redirect()->to('/')->with('good', 'You actuvated!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| Admin routes group
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function() {

	Route::get('/{id}', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');

});

/*
|--------------------------------------------------------------------------
| Moderator routes group
|--------------------------------------------------------------------------
*/

Route::prefix('moderator')->group(function() {

	Route::get('/{id}', [App\Http\Controllers\Moderator\ModeratorController::class, 'index'])->name('moderator.home');
    Route::get('/{id}/moderation/{ad}/show', [App\Http\Controllers\Moderator\ModeratorController::class, 'showModerationOnAd'])->name('showModerationOnAd');
    Route::post('/{id}/moderation/{ad}/why', [App\Http\Controllers\Moderator\ModeratorController::class, 'why'])->name('why');
    Route::patch('/{id}/moderation/{ad}/active', [App\Http\Controllers\Moderator\ModeratorController::class, 'makeActiveAd'])->name('makeActiveAd');

});

/*
|--------------------------------------------------------------------------
| User routes group
|--------------------------------------------------------------------------
*/

Route::prefix('user')->group(function() {

	Route::get('/{id}', [App\Http\Controllers\User\UserController::class, 'index'])->name('user.home');
    Route::get('/{id}/create-ad', [App\Http\Controllers\User\UserController::class, 'showForm'])->name('showForm');
    Route::post('/{id}/create-ad', [App\Http\Controllers\User\UserController::class, 'createAd'])->name('createAd');
    Route::get('{id}/ad/{ad}', [App\Http\Controllers\User\UserController::class, 'showAd'])->name('showAd');

    Route::get('{id}/ad/{ad}/edit', [App\Http\Controllers\User\UserController::class, 'editDraftAd'])->name('editDraftAd');
    Route::patch('{id}/ad/{ad}/edit', [App\Http\Controllers\User\UserController::class, 'updateDraftAd'])->name('updateDraftAd');
    Route::delete('{id}/ad/{ad}/delete', [App\Http\Controllers\User\UserController::class, 'deleteDraftAd'])->name('deleteDraftAd');

    Route::patch('/{id}/ad/{ad}/moderation', [App\Http\Controllers\User\UserController::class, 'sendToModer'])->name('sendToModer');
});