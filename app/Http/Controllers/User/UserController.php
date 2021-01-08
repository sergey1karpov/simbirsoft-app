<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use App\Models\City;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewAdRequest;


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

	/**
     * Create user ad
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
	public function createAd(NewAdRequest $request, $id) 
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

			//Add main photo	
			if($request->file('photo')) {
				$path = Storage::putFile('public/'.auth()->user()->id.'/ad', $request->file('photo'));
				$url = Storage::url($path);
				$ad->photo = $url;
			}

			//Add addotional photos
			$photos = [];
			$urls = [];

			if($request->file('photos')) {
				foreach($request->file('photos') as $key => $photo) {
					$photos[] = Storage::putFile('public/'.auth()->user()->id.'/ad', $photo);
				}
				foreach($photos as $photo) {
					$urls[] = Storage::url($photo);
				}
				$ad->photos = serialize($urls);
			}

			$ad->price = $request->price;
			$ad->user_id = auth()->user()->id;
			$ad->save();

			return redirect()->back()->with('status', 'Your ad is sending to moderator');
		}
	}

}
