<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateNewUserMail;
use Illuminate\Support\Facades\Hash;
use App\Notifications\WelcomeNewUserPassword;
use Illuminate\Auth\Passwords\PasswordBroker;

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
		$moderationAds = Ad::where('status', Ad::ON_MODERATION)->get();
		
		if($admin->role == User::ADMIN && $admin->id == $id) {
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
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$validated = $request->validate([
	        'name' => 'required',

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
			$newUser->password = Hash::make(substr(str_shuffle($chars), 0, 25));
			$token = app(PasswordBroker::class)->createToken($newUser);
			$newUser->remember_token = $token;
			$newUser->save();

			//Notification for user
			$newUser->notify(new WelcomeNewUserPassword($token));


			return redirect()->back()->with('status', 'User creted');
		}
	}

	public function changeStatus($id, $userId)
	{
		$admin = User::findOrFail($id);
		if($admin) {
			$changeUserStatus = User::findOrFail($userId);
			
			if($changeUserStatus->status == User::ACTIVE) {
				$changeUserStatus->status = User::BANNED;
				$changeUserStatus->update();
				return redirect()->back()->with('status', 'User banned');
			}

			if($changeUserStatus->status == User::BANNED) {
				$changeUserStatus->status = User::ACTIVE;
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
			
			if($changeUserRole->role == User::MODERATOR) {
				$changeUserRole->role = User::USER;
				$changeUserRole->update();
				return redirect()->back()->with('status', 'Make user');
			}

			if($changeUserRole->role == User::USER) {
				$changeUserRole->role = User::MODERATOR;
				$changeUserRole->update();
				return redirect()->back()->with('status', 'make moder');
			}
		}
	}

	
}
