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
use App\Models\Region;

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

	public function regionsAndCities($id)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$regions = Region::all();
			$cities = City::all();
			return view('admin.all_regions', compact('regions', 'cities'));
		} else {
			abort(404);
		}
	}

	public function addRegion(Request $request, $id)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$region = new Region();
			$region->name = $request->region_name;
			$region->slug = $request->region_slug;
			$region->save();

			return redirect()->back()->with('status', 'Region added');
		} else {
			abort(404);
		}
	}

	public function updateRegion(Request $request, $id, $region)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$reg = Region::findOrFail($region);
			$reg->name = $request->upd_region_name;
			$reg->slug = $request->upd_region_slug;
			$reg->update();
			return redirect()->back()->with('status', 'region update');
		} else {
			return abort(404);
		}
	}

	public function deleteRegion($id, $region) 
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$reg = Region::findOrfail($region);
			$reg->delete();
			return redirect()->back()->with('status', 'region deleted');
		} else {
			abort(404);
		}
	}

	public function addCity(Request $request, $id) 
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$city = new City();
			$city->name = $request->city_name;
			$city->slug = $request->city_slug;
			$city->region_id = $request->region_id;
			$city->region_slug = $request->region_slug;
			$city->save();

			return redirect()->back()->with('status', 'City added');
		} else {
			return abort(404);
		}
	}

	public function updateCity(Request $request, $id, $city)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$city = City::findOrFail($city);
			$city->name = $request->up_city_name;
			$city->slug = $request->up_city_slug;
			$city->region_id = $request->up_region_id;
			$city->region_slug = $request->up_region_slug;
			$city->update();
			return redirect()->back()->with('status', 'City updated');
		} else {
			abort(404);
		}
	}

	public function deleteCity($id, $city)
	{
		$admin = User::find($id);
		if(auth()->user()->role == User::ADMIN && auth()->user()->id == $id) {
			$delCity = City::findOrFail($city);
			$delCity->delete();
			return redirect()->back()->with('status', 'City deleted');
		} else {
			return abort(404);
		}
	}







































	
}
