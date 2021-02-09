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
		$activeAds = $user->ads()->where('status', Ad::ACTIVE)->get();
		$draftAds = $user->ads()->where('status', Ad::DRAFT)->get();
		$moderationAds = $user->ads()
			->where('status', Ad::ON_MODERATION)
			->orWhere('status', Ad::REJECTED)
			->get();
		$deleted = $user->ads()->onlyTrashed()->get();	

		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			return view('user.user_home', compact('user', 'draftAds', 'moderationAds', 'activeAds', 'deleted'));
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

		$data = Category::get();

		$categories = $data->whereNull('parent_slug')->all();
		$subCats = $data->whereNotNull('parent_slug')->all();

		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			return view('user.show_ad_form', compact('user', 'cities', 'categories', 'subCats'));
		} else {
			return abort(404);
		}
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

		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			if($user->status == USER::NO_ACTIVE) {
				return redirect()->back()->with('status', 'Your account is not activated. Please confirm your email');
			} else {
				Ad::newUserAd($request->all());
				return redirect()->route('user.home', ['id' => auth()->user()->id])->with('status', 'Your ad is draft');
			}
		} else {
			return abort(404);
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

		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			$draftAd = Ad::findOrFail($ad);
			$categories = Category::all();
			$whyFalse = $draftAd->moderation()->where('ad_id', $ad)->latest()->first();
			return view('user.draftAd', compact('user', 'draftAd', 'whyFalse', 'categories'));
		} else {
			return abort(404);
		}
	}

	public function editDraftAd($id, $ad) 
	{
		$user = User::findOrFail($id);
		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			$draftAd = Ad::findOrFail($ad);
			if($ad) {
				$city = $draftAd->city()->where('id', $draftAd->city_id)->get();
				$cities = City::all();
				$categories = Category::all();
				return view('user.edit_draft_ad_form', compact('user', 'draftAd', 'cities', 'city', 'categories'));
			}
		} else {
			return abort(404);
		}
	}

	public function updateDraftAd(NewAdRequest $request, $id, $ad) 
	{
		$user = User::findOrFail($id);
		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			$ad = Ad::findOrFail($ad);
			if($ad) {

				if($ad->status == Ad::ON_MODERATION || $ad->status == User::ACTIVE) {
					return redirect()->back()->with('status', 'Sorry, You cant edit this ad');
				}

				Ad::updateUserAd($request->all(), $ad);

				return redirect()->back()->with('status', 'Your ad is update');
			}
		} else {
			return abort(404);
		}
	}

	public function deleteDraftAd($id, $ad) 
	{
		$user = User::findOrFail($id);
		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			$ad = Ad::findOrFail($ad);
			if($ad) {

				if($ad->status == Ad::ON_MODERATION) {
					return redirect()->back()->with('status', 'Sorry, the ad on moderation');
				}

				$ad->delete();
				return redirect()->route('user.home', ['id' => auth()->user()->id])->with('status', 'Draft ad is deleted');
			}
		} else {
			return abort(404);
		}
	}

	public function sendToModer($id, $ad)
	{
		$user = User::findOrFail($id);
		if(auth()->user()->id == $id && auth()->user()->role == User::USER) {
			$ad = Ad::findOrFail($ad);
			if($ad) {
				$ad->status = Ad::ON_MODERATION;
				$ad->update();

				return redirect()->back()->with('status', 'Your ad send on moder');
			} 
		} else {
			return abort(404);
		}
	} 

}
