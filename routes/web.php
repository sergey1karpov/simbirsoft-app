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

Auth::routes();

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
// Route::get('/{slug}', [App\Http\Controllers\IndexController::class, 'show'])->name('show');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| test routes for categories(3ree cats tree)
|--------------------------------------------------------------------------
*/

//All cities
Route::get('cities', [App\Http\Controllers\IndexController::class, 'cities'])->name('cities');

//All ads in city
Route::get('cities/{city}', [App\Http\Controllers\IndexController::class, 'sCity'])->name('sCity');

//All ads in category in city and subCats
Route::get('cities/{city}/{category}', [App\Http\Controllers\IndexController::class, 'sCat'])->name('sCat');
// Route::get('test/{city}/{category}/{subCatOne?}', [App\Http\Controllers\IndexController::class, 'subCatOne'])->name('subCatOne');
// Route::get('test/{city}/{category}/{subCatOne?}/{subCatTwo?}', [App\Http\Controllers\IndexController::class, 'subCatTwo'])->name('subCatTwo');

//Detail product
// Route::get('test/{city}/{category}/{slug}', [App\Http\Controllers\IndexController::class, 'sSlug'])->name('sSlug');
Route::get('cat/detail/{slug}', [App\Http\Controllers\IndexController::class, 'sSlug'])->name('sSlug');

/*
|--------------------------------------------------------------------------
| Confirm email route
|--------------------------------------------------------------------------
*/
Route::get('/email/verify', [App\Http\Controllers\Auth\ConfirmAccountController::class, 'verificationNotice'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\ConfirmAccountController::class, 'verificationVerify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [App\Http\Controllers\Auth\ConfirmAccountController::class, 'verificationVend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| Admin routes group
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function() {

	Route::get('/{id}', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.home');
    Route::get('/{id}/create-user', [App\Http\Controllers\Admin\AdminController::class, 'showCreateUserForm'])->name('showCreateUserForm');
    Route::post('/{id}/create-user', [App\Http\Controllers\Admin\AdminController::class, 'createUser'])->name('createUser');

    Route::patch('/{id}/status/{userId}', [App\Http\Controllers\Admin\AdminController::class, 'changeStatus'])->name('changeStatus');
    Route::patch('/{id}/role/{userId}', [App\Http\Controllers\Admin\AdminController::class, 'changeRole'])->name('changeRole');

    //CRUD Categories
    Route::get('/{id}/categories', [App\Http\Controllers\Admin\AdminController::class, 'getAllCats'])->name('getAllCats');
    Route::post('/{id}/categories', [App\Http\Controllers\Admin\AdminController::class, 'addCat'])->name('addCat');
    Route::patch('/{id}/categories/{cat}/update', [App\Http\Controllers\Admin\AdminController::class, 'updateCat'])->name('updateCat');
    Route::delete('/{id}/categories/{cat}/delete', [App\Http\Controllers\Admin\AdminController::class, 'delCat'])->name('delCat');

    //CRUD Cities
    Route::get('/{id}/cities', [App\Http\Controllers\Admin\AdminController::class, 'getAllCities'])->name('getAllCities');
    Route::post('/{id}/cities', [App\Http\Controllers\Admin\AdminController::class, 'addCity'])->name('addCity');
    Route::patch('/{id}/cities/{city}/update', [App\Http\Controllers\Admin\AdminController::class, 'updateCity'])->name('updateCity');
    Route::delete('/{id}/cities/{city}/delete', [App\Http\Controllers\Admin\AdminController::class, 'delCity'])->name('delCity');
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