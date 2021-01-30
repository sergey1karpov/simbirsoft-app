<?php

namespace App\Http\Controllers;
use App\Models\Ad;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Category;

class IndexController extends Controller
{
    public function index() 
    {
    	$ads = Ad::where('status', Ad::ACTIVE)->get();
    	return view('index', compact('ads'));
    }

    // public function show($slug)
    // {
    // 	$ad = Ad::where('slug', $slug)->firstOrFail();
    // 	return view('ad', compact('ad'));
    // }





    public function cities()
    {
        $cities = City::all();
        return view('categories.cities', compact('cities'));
    }


    public function sCity($sCity) 
    {
        $cityAds = Ad::where('city_slug', $sCity)->get();
        return view('categories.city_ad', compact('cityAds'));
    }

    public function sCat($sCity, $sCategory)
    {
        $cityAndCat = Ad::where('city_slug', $sCity)->where('category_slug', $sCategory)->get();
        return view('categories.category_ad', compact('cityAndCat'));
    }

    // public function sSlug($city, $category, $slug) 
    // {
    //     $fullAd = Ad::where('city_id', $city)->where('category_id', $category)->where('slug', $slug)->get();
    //     dd($fullAd);
    // }

    public function sSlug($slug) 
    {
        $fullAd = Ad::where('slug', $slug)->first();
        $user = $fullAd->user;
        return view('ad', compact('fullAd', 'user'));
    }
}
