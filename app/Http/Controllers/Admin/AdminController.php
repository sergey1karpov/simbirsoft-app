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
		$admin = User::find($id);
		
		if($admin->role == 'Admin') {
			return view('admin.admin_home', compact('admin'));
		} else {
			return abort(404);
		}	
	}
}
