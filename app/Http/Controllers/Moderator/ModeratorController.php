<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ModeratorController extends Controller
{
    /**
     * Return Moderator home page
     */
	public function index($id)
	{
		$moderator = User::findOrFail($id);
		
		if($moderator->role == 'Moderator' && $user->id == $id) {
			return view('moderator.moderator_home', compact('moderator'));
		} else {
			return abort(404);
		}	
	}
}
