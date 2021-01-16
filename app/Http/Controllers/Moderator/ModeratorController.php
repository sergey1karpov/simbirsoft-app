<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use App\Models\Moderation;
use Illuminate\Support\Carbon;
use App\Models\Category;

class ModeratorController extends Controller
{
    /**
     * Return Moderator home page
     */
	public function index($id)
	{
		$moderator = User::findOrFail($id);
		
		if($moderator->role == 'Moderator' && $moderator->id == $id) {
			$ads = Ad::where('status', 'on moderation')->get();
			return view('moderator.moderator_home', compact('moderator', 'ads'));
		} else {
			return abort(404);
		}	
	}

	public function showModerationOnAd($id, $ad)
	{
		$moderator = User::findOrFail($id);

		if($moderator) {
			$ad = Ad::findOrFail($ad);
			$userAd = $ad->user()->where('id', $ad->user_id)->first();
			if($ad) {
				return view('moderator.ad_on_moderation', compact('ad', 'userAd'));
			}
		}
	}

	/**
     * Why user ad is shit
     */
	public function why(Request $request, $id, $ad)
	{
		$moderator = User::findOrFail($id);

		if($moderator) {
			$ad = Ad::findOrFail($ad);

			if($ad) {
				$moderatingAd = new Moderation();
				$moderatingAd->ad_id = $ad->id;
				$moderatingAd->user_id = $moderator->id;
				$moderatingAd->decesion = 'False';
				$moderatingAd->why = $request->why;
				$moderatingAd->moderation_date = Carbon::now();
				$moderatingAd->save();

				$ad->status = 'false';
				$ad->update();

				return redirect()->back()->with('status', 'Your review id send to user');
			}
		}
	}

	public function generateUrl($url)
	{
		$aaa = [];
		$cats = Category::find($url)->ancestorsAndSelf;
		$categories = $cats->reverse();
		foreach($categories as $aa) {
			$aaa[] = $aa->slug;
		}
		$bbb = implode(',', $aaa);
		$x = str_replace(',', '-', $bbb);
		return $x.'-product-'.getrandmax();
	}

	public function makeActiveAd(Request $request, $id, $ad)
	{
		$moderator = User::findOrFail($id);

		if($moderator) {
			$ad = Ad::findOrFail($ad);
			if($ad) {

				$moderatingAd = new Moderation();
				$moderatingAd->ad_id = $ad->id;
				$moderatingAd->user_id = $moderator->id;
				$moderatingAd->decesion = 'Active';
				$moderatingAd->why = $request->why;
				$moderatingAd->moderation_date = Carbon::now();		
				$moderatingAd->save();

				$ad->slug = $this->generateUrl($ad->category_id);
				$ad->status = 'active';
				$ad->update();

				return redirect()->back()->with('status', 'Ad is active');
			}
		}
	}
}




