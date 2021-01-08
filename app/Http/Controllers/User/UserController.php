<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use App\Models\City;

class UserController extends Controller
{
    /**
     * Return User home page
     */
	public function index($id)
	{
		$user = User::findOrFail($id);

		if($user->role == 'User' && $user->id == $id) {
			return view('user.user_home', compact('user'));
		} else {
			return abort('404');
		}	
	}

	/**
     * Show form for create new ad
     */
	public function showForm($id) 
	{
		$user = User::findOrFail($id);
		$cities = City::all();

		return view('user.show_ad_form', compact('user', 'cities'));
	}

	public function createAd(Request $request, $id) 
	{
		$user = User::findOrFail($id);

		if($user->status == 'No Active') {
			return redirect()->back()->with('status', 'Your account is not activated. Please confirm your email');
		} else {
			$ad = new Ad();
			$ad->title = $request->title;
			$ad->category_id = 1;
			$ad->city_id = $request->city;
			$ad->description = $request->description;
			$ad->photos = 'photo';
			$ad->price = $request->price;
			$ad->user_id = auth()->user()->id;
			$ad->save();

			return redirect()->back();
		}
	}

}
