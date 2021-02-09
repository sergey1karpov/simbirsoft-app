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
Route::get('regions', [App\Http\Controllers\IndexController::class, 'regions'])->name('regions');

//All cities
Route::get('{region}/cities', [App\Http\Controllers\IndexController::class, 'cities'])->name('cities');

//All ads in city
Route::get('{region}/{city}/ads', [App\Http\Controllers\IndexController::class, 'sCity'])->name('sCity');

//All ads in category in city and subCats
Route::get('{region}/{city}/{category}/ads', [App\Http\Controllers\IndexController::class, 'sCat'])->name('sCat');

//Detail product
Route::get('cat/detail/{slug}', [App\Http\Controllers\IndexController::class, 'sSlug'])->name('sSlug');

Route::get('categories/{slug?}', [App\Http\Controllers\IndexController::class, 'allAdInCategory'])->name('allAdInCategory');

Route::get('categories/{slug?}/{subSlug}', [App\Http\Controllers\IndexController::class, 'allAdInSubCategory'])->name('allAdInSubCategory');

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

    Route::get('/{id}/categories/{category}/subcats', [App\Http\Controllers\Admin\AdminController::class, 'getSubCats'])->name('getSubCats');
    Route::post('/{id}/categories/{category}/subcats', [App\Http\Controllers\Admin\AdminController::class, 'addSubCats'])->name('addSubCats');
    Route::patch('/{id}/categories/{category}/subcats/{subcate}/update', [App\Http\Controllers\Admin\AdminController::class, 'updateSubCats'])->name('updateSubCats');
    Route::delete('/{id}/categories/{category}/subcats/{subcate}/delete', [App\Http\Controllers\Admin\AdminController::class, 'deleteSubCats'])->name('deleteSubCats');

    //CRUD Regions
    Route::get('/{id}/regions-and-cities', [App\Http\Controllers\Admin\AdminController::class, 'regionsAndCities'])->name('regionsAndCities');

    Route::post('/{id}/regions-and-cities/adregion', [App\Http\Controllers\Admin\AdminController::class, 'addRegion'])->name('addRegion');
    Route::post('/{id}/regions-and-cities/adcity', [App\Http\Controllers\Admin\AdminController::class, 'addCity'])->name('addCity');

    Route::patch('/{id}/regions-and-cities/region/{region}/up-region', [App\Http\Controllers\Admin\AdminController::class, 'updateRegion'])->name('updateRegion');
    Route::patch('/{id}/regions-and-cities/city/{city}/up-city', [App\Http\Controllers\Admin\AdminController::class, 'updateCity'])->name('updateCity');

    Route::delete('/{id}/regions-and-cities/region/{region}/del-region', [App\Http\Controllers\Admin\AdminController::class, 'deleteRegion'])->name('deleteRegion');
    Route::delete('/{id}/regions-and-cities/city/{city}/del-region', [App\Http\Controllers\Admin\AdminController::class, 'deleteCity'])->name('deleteCity');

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

Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get('/es', [App\Http\Controllers\SearchController::class, 'esSearch'])->name('esSearch');

