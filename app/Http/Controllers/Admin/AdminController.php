<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Return Admin home page
     */
	public function index($id)
	{
		$admin = User::findOrfail($id);
		
		if($admin->role == 'Admin' && $user->id == $id) {
			return view('admin.admin_home', compact('admin'));
		} else {
			return abort(404);
		}	
	}
}
