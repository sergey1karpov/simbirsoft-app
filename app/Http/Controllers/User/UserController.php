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
use App\Models\Category;


class UserController extends Controller
{
    /**
     * Return User home page
     */
	public function index($id)
	{
		$user = User::findOrFail($id);
		$activeAds = $user->ads()->where('status', 'active')->get();
		$draftAds = $user->ads()->where('status', 'draft')->get();
		$moderationAds = $user->ads()
			->where('status', 'on moderation')
			->orWhere('status', 'false')
			->get();

		if($user->role == 'User' && $user->id == $id) {
			return view('user.user_home', compact('user', 'draftAds', 'moderationAds', 'activeAds'));
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

		$categories = Category::isLeaf()->get();

		return view('user.show_ad_form', compact('user', 'cities', 'categories'));
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
			$ad->category_id = $request->category;
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

			$categories = Category::find($draftAd->category_id)->ancestorsAndSelf;

			$whyFalse = $draftAd->moderation()->where('ad_id', $ad)->latest()->first();
			return view('user.draftAd', compact('user', 'draftAd', 'whyFalse', 'categories'));
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

				if($ad->status == 'on moderation' || $ad->status == 'active') {
					return redirect()->back()->with('status', 'Sorry, You cant edit this ad');
				}

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

				if($ad->status == 'on moderation') {
					return redirect()->back()->with('status', 'Sorry, the ad on moderation');
				}

				$ad->delete();
				return redirect()->route('user.home', ['id' => auth()->user()->id])->with('status', 'Draft ad is deleted');
			}
		}
	}

	public function sendToModer($id, $ad)
	{
		$user = User::findOrFail($id);
		if($user) {
			$ad = Ad::findOrFail($ad);
			if($ad) {
				$ad->status = 'on moderation';
				$ad->update();

				return redirect()->back()->with('status', 'Your ad send on moder');
			}
		}
	} 

}
