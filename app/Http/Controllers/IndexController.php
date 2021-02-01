<?php

namespace App\Http\Controllers;
use App\Models\Ad;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * All active ads in index page
     */
    public function index() 
    {
    	$ads = Ad::where('status', Ad::ACTIVE)->get();
    	return view('index', compact('ads'));
    }

    /**
     * All regions
     */
    public function regions()
    {
        $regions = Region::all();
        return view('categories.regions', compact('regions'));
    }

    /**
     * All cities in region and all ads in region
     */
    public function cities($region)
    {
        $cities = DB::table('regions')
            ->join('cities', 'cities.region_slug', 'regions.slug')
            ->where('cities.region_slug', $region)
            ->get();
        $ads = DB::table('regions')
            ->join('cities', 'cities.region_slug', 'regions.slug')
            ->join('ads', 'ads.city_slug', 'cities.slug')
            ->where('cities.region_slug', $region)
            ->where('ads.status', Ad::ACTIVE)
            ->get();
        $reg = Region::where('slug', $region)->first();

        return view('categories.cities', compact('cities', 'ads', 'reg'));
    }

    /**
     * All ads in city
     */
    public function sCity($region, $city) 
    {
        $cityAds = DB::table('ads')
            ->join('cities', 'cities.slug', 'ads.city_slug')
            ->join('regions', 'regions.slug', 'cities.region_slug')
            ->where('regions.slug', $region)
            ->where('cities.slug', $city)
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
        $ads = DB::table('ads')
            ->where('city_slug', $city) 
            ->where('ads.status', Ad::ACTIVE)
            ->get();        

        return view('categories.city_ad', compact('cityAds', 'ads'));
    }

    /**
     * All ads in category
     */
    public function sCat($region, $city, $category)
    {   
        $cityAndCat = DB::table('ads')
            ->join('categories', 'categories.slug', 'ads.category_slug')
            ->join('cities', 'cities.slug', 'ads.city_slug')
            ->join('regions', 'regions.slug', 'cities.region_slug')
            ->where('regions.slug', $region)
            ->where('cities.slug', $city)
            ->where('categories.slug', $category)
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
        $ads = DB::table('ads')
            ->where('city_slug', $city) 
            ->where('category_slug', $category)
            ->where('ads.status', Ad::ACTIVE)
            ->get();    

        return view('categories.category_ad', compact('cityAndCat', 'ads'));
    }

    public function allAdInCategory($slug = null)
    {
        // $ads = DB::table('ads')
        //     ->join('categories', 'categories.slug', 'ads.category_slug')
        //     ->where('categories.slug', $slug)
        //     ->where('ads.status', Ad::ACTIVE)
        //     ->get(); 
        $ads = DB::table('ads')
            ->where('category_slug', $slug)   
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
         
        return view('categories.cat_ads', compact('ads'));    
    }

    /**
     * Detail ad
     */
    public function sSlug($slug) 
    {
        $fullAd = Ad::where('slug', $slug)->first();
        $user = $fullAd->user;
        return view('ad', compact('fullAd', 'user'));
    }
}
