<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminController extends Controller
{
	use RegistersUsers;
    /**
     * Return Admin home page
     */
	public function index($id)
	{
		$admin = User::findOrfail($id);
		$allUsers = User::orderBy('id')->get();
		$moderationAds = Ad::where('status', 'on moderation')->get();
		
		if($admin->role == 'Admin' && $admin->id == $id) {
			return view('admin.admin_home', compact('admin', 'allUsers', 'moderationAds'));
		} else {
			return abort(404);
		}	
	}

	public function showCreateUserForm($id)
	{
		$admin = User::findOrFail($id);
		if($admin) {
			return view('admin.create_new_user', compact('admin'));
		} else {
			return abort(404);
		}
	}

	public function createUser(Request $request, $id)
	{

		$validated = $request->validate([
	        'password' => 'required',
	        'password_confirmation' => 'required|same:password',
	    ]);

		$admin = User::find($id);

		if($admin) {
			$newUser = new User();
			$newUser->name = $request->name;
			$newUser->surname = $request->surname;
			$newUser->telephone = $request->telephone;
			$newUser->email = $request->email;
			$newUser->role = $request->role;
			$newUser->status = $request->status;
			$newUser->password = md5($request->password);
			$newUser->save();

			return redirect()->back()->with('status', 'User creted');
		}
	}

	public function changeStatus($id, $userId)
	{
		$admin = User::findOrFail($id);
		if($admin) {
			$changeUserStatus = User::findOrFail($userId);
			
			if($changeUserStatus->status == 'Active') {
				$changeUserStatus->status = 'Banned';
				$changeUserStatus->update();
				return redirect()->back()->with('status', 'User banned');
			}

			if($changeUserStatus->status == 'Banned') {
				$changeUserStatus->status = 'Active';
				$changeUserStatus->update();
				return redirect()->back()->with('status', 'User Activated');
			}
		}
	}

	public function changeRole($id, $userId)
	{
		$admin = User::findOrFail($id);
		if($admin) {
			$changeUserRole = User::findOrFail($userId);
			
			if($changeUserRole->role == 'Moderator') {
				$changeUserRole->role = 'User';
				$changeUserRole->update();
				return redirect()->back()->with('status', 'Make user');
			}

			if($changeUserRole->role == 'User') {
				$changeUserRole->role = 'Moderator';
				$changeUserRole->update();
				return redirect()->back()->with('status', 'make moder');
			}
		}
	}

	public function deleteUserAd()
	{

	}

	
}
