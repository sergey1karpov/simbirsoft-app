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
		$draftAds = $user->ads()->where('status', 'draft')->get();

		if($user->role == 'User' && $user->id == $id) {
			return view('user.user_home', compact('user', 'draftAds'));
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
				$ad->photo = Ad::addMainPhoto($request->file('photo'));
			}

			//Add addotional photos
			if($request->file('photos')) {
				$ad->photos = Ad::addAdditionalPhoto($request->file('photos'));
			}

			$ad->price = $request->price;
			$ad->user_id = auth()->user()->id;
			$ad->save();

			return redirect()->route('user.home', ['id' => auth()->user()->id])->with('status', 'Your ad is draft');
		}
	}

	/**
     * Show user draft ad
     *
	 * @param  App\Models\User  $id
     * @param  App\Models\Ad  $ad
     */
	public function showAd($id, $ad) 
	{
		$user = User::findOrFail($id);
		if($user) {
			$draftAd = Ad::findOrFail($ad);
			return view('user.draftAd', compact('user', 'draftAd'));
		}
	}

	public function editDraftAd($id, $ad) 
	{
		$user = User::findOrFail($id);
		if($user) {
			$draftAd = Ad::findOrFail($ad);
			if($ad) {
				$city = $draftAd->city()->where('id', $draftAd->city_id)->get();
				$cities = City::all();
				return view('user.edit_draft_ad_form', compact('user', 'draftAd', 'cities', 'city'));
			}
		}
	}

	public function updateDraftAd(NewAdRequest $request, $id, $ad) 
	{
		$user = User::findOrFail($id);
		if($user) {
			$ad = Ad::findOrFail($ad);
			if($ad) {
				$ad->title = $request->title;
				$ad->category_id = 1;
				$ad->city_id = $request->city;
				$ad->description = $request->description;
				$ad->price = $request->price;
				$ad->user_id = auth()->user()->id;

				//Update main photo	
				if($request->file('photo')) {
					$ad->photo = Ad::addMainPhoto($request->file('photo'));
				}

				//Update addotional photos
				if($request->file('photos')) {
					$ad->photos = Ad::addAdditionalPhoto($request->file('photos'));
				}

				$ad->update();

				return redirect()->back()->with('status', 'Your ad is update');
			}
		}
	}

	public function deleteDraftAd($id, $ad) 
	{
		$user = User::findOrFail($id);
		if($user) {
			$ad = Ad::findOrFail($ad);
			if($ad) {
				$ad->delete();
				return redirect()->route('user.home', ['id' => auth()->user()->id])->with('status', 'Draft ad is deleted');
			}
		}
	}

}
