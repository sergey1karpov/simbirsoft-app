<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use App\Models\Moderation;
use Illuminate\Support\Carbon;
use App\Models\Category;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ErrorAdNotification;
use App\Jobs\ErrorAdJob;

class ModeratorController extends Controller
{
    /**
     * Return Moderator home page
     */
	public function index($id)
	{
		$moderator = User::findOrFail($id);
		
		if(auth()->user()->role == User::MODERATOR && auth()->user()->id == $id) {
			$ads = Ad::where('status', Ad::ON_MODERATION)->get();
			return view('moderator.moderator_home', compact('moderator', 'ads'));
		} else {
			return abort(404);
		}	
	}

	public function showModerationOnAd($id, $ad)
	{
		$moderator = User::findOrFail($id);

		if(auth()->user()->role == User::MODERATOR || auth()->user()->role == User::ADMIN) {
			$ad = Ad::findOrFail($ad);
			$userAd = $ad->user()->where('id', $ad->user_id)->first();
			if($ad) {
				return view('moderator.ad_on_moderation', compact('ad', 'userAd'));
			}
		} else {
			return abort(404);
		}	
	}

	/**
     * Why user ad is shit
     */
	public function why(Request $request, $id, $ad)
	{
		$moderator = User::findOrFail($id);

		if(auth()->user()->role == User::MODERATOR || auth()->user()->role == User::ADMIN) {
			$ad = Ad::findOrFail($ad);
			$user = User::find($ad->user_id);

			if($ad) {
				$moderatingAd = new Moderation();
				$moderatingAd->ad_id = $ad->id;
				$moderatingAd->user_id = $moderator->id;
				$moderatingAd->decesion = Moderation::DO_NOT_PUBLISH;
				$moderatingAd->why = $request->why;
				$moderatingAd->moderation_date = Carbon::now();
				$moderatingAd->save();

				$ad->status = Ad::REJECTED;
				$ad->update();
				
				//If ad is shit, we sending to notify
				// Notification::send($user, new ErrorAdNotification($user, $ad, $moderatingAd));
				ErrorAdJob::dispatch($user, $ad, $moderatingAd);

				return redirect()->back()->with('status', 'Your review id send to user');
			}
		}
	}

	public function generateUrl()
	{
		return '-'.mt_rand(1000000000, 9999999999);
	}

	public function makeActiveAd(Request $request, $id, $ad)
	{
		$moderator = User::findOrFail($id);

		if(auth()->user()->role == User::MODERATOR || auth()->user()->role == User::ADMIN) {
			$ad = Ad::findOrFail($ad);
			if($ad) {

				$moderatingAd = new Moderation();
				$moderatingAd->ad_id = $ad->id;
				$moderatingAd->user_id = $moderator->id;
				$moderatingAd->decesion = Moderation::TO_PUBLISH;
				$moderatingAd->why = $request->why;
				$moderatingAd->moderation_date = Carbon::now();		
				$moderatingAd->save();

				$ad->slug = $ad->slug.$this->generateUrl();
				$ad->status = Ad::ACTIVE;
				$ad->update();

				return redirect()->back()->with('status', 'Ad is active');
			}
		}
	}
}




