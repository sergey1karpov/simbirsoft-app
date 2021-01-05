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
		$moderator = User::find($id);
		
		if($moderator->role == 'Moderator') {
			return view('moderator.moderator_home', compact('moderator'));
		} else {
			return abort(404);
		}	
	}
}
