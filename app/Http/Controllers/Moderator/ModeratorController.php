<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;

class ModeratorController extends Controller
{
    /**
     * Return Moderator home page
     */
	public function index($id)
	{
		$moderator = User::findOrFail($id);
		
		if($moderator->role == 'Moderator' && $moderator->id == $id) {
			$ads = Ad::where('status', 'On Moderation')->get();
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
}

