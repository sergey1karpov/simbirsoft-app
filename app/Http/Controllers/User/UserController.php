<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Return User home page
     */
	public function index($id)
	{
		$user = User::find($id);
		
		if($user->role == 'User') {
			return view('user.user_home', compact('user'));
		} else {
			return abort('404');
		}	
	}

}
