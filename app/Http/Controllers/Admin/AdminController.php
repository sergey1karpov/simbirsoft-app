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
use App\Models\Category;
use App\Models\City;

class AdminController extends Controller
{
	use RegistersUsers;
    /**
     * Return Admin home page
     */
	public function index($id)
	{
		$admin = User::findOrfail($id);
		$allUsers = User::orderBy('id')->paginate(30);
		$moderationAds = Ad::where('status', Ad::ON_MODERATION)->get();
		
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
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
			$newUser->remember_token = app(PasswordBroker::class)->createToken($newUser);
			$newUser->save();

			//Notification for user
			$newUser->notify(new WelcomeNewUserPassword($newUser->remember_token));


			return redirect()->back()->with('status', 'User created');
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

	public function getAllCats($id)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$cats = Category::all();
			return view('admin.all_cat', compact('cats'));
		} else {
			abort(404);
		}
		
	}

	public function addCat(Request $request, $id)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			Category::create([
				'name' => $request->name,
				'slug' => $request->slug,
				'description' => $request->description,
			]);

			return redirect()->back()->with('status', 'Category added');
		} else {
			return abort(404);
		}
	}

	public function delCat($id, $cat)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$catty = Category::findOrfail($cat);
			$catty->delete();
			return redirect()->back()->with('status', 'Cetegory deleted');
		} else {
			abort(404);
		}
	}

	public function updateCat(Request $request, $id, $cat) 
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$catty = Category::findOrFail($cat);
			$catty->name = $request->name;
			$catty->slug = $request->slug;
			$catty->description = $request->description;
			$catty->update();

			return redirect()->back()->with('status', 'Category updated');
		} else {
			abort(404);
		}
	}

	public function getAllCities($id)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$cities = City::all();
			return view('admin.all_cities', compact('cities'));
		} else {
			abort(404);
		}
	}

	public function addCity(Request $request, $id)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			City::create([
				'name' => $request->name,
				'slug' => $request->slug,
			]);

			return redirect()->back()->with('status', 'City added');
		} else {
			abort(404);
		}
	}

	public function updateCity(Request $request, $id, $city)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$cittty = City::findOrFail($city);
			$cittty->name = $request->name;
			$cittty->slug = $request->slug;
			$cittty->update();

			return redirect()->back()->with('status', 'City updated');
		} else {
			abort(404);
		}

	}

	public function delCity($id, $city)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$del = City::findOrFail($city);
			$del->delete();
			return redirect()->back()->with('status', 'City deleted');
		} else {
			abort(404);
		}
	}

	
}
