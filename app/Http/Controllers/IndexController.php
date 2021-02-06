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
     * Get all active ads in main page
     */
    public function index() 
    {
    	$ads = Ad::where('status', Ad::ACTIVE)->get();
    	return view('index', compact('ads'));
    }

    /**
     * Get all regions
     */
    public function regions()
    {
        $regions = Region::all();
        return view('categories.regions', compact('regions'));
    }

    /**
     * Get all cities in the region and all ads in the region
     */
    public function cities($region)
    {
        $cities = Category::getCities($region);  //get all cities in region  
        $ads = Category::getCitiesAds($region);  //get all ads in region
        $reg = Region::where('slug', $region)->first(); //get region
        return view('categories.cities', compact('cities', 'ads', 'reg'));
    }

    /**
     * All ads in city
     */
    public function sCity($region, $city) 
    {
        $cityAds = Category::getCategoryInCity($region, $city); //get all cats in city
        $ads = Category::getAdsInCity($city); //get all ads in city       
        return view('categories.city_ad', compact('cityAds', 'ads'));
    }

    /**
     * All ads in category
     */
    public function sCat($region, $city, $category)
    {   
        $ads = Category::getAdsInCategory($city, $category); //get all ads in the category and in the city 
        return view('categories.category_ad', compact( 'ads'));
    }

    /**
     * Get all ads in category without city
     */
    public function allAdInCategory($slug = null)
    {
        $ads = Category::getAllAdsInCategory($slug); //get all ads in category    
        $subCats = Category::getSubCatsInCategory($slug);  //get subcats in parent cat  
        return view('categories.cat_ads', compact('ads', 'subCats'));    
    }

    public function allAdInSubCategory($slug = null, $subSlug)
    {
        $ads = Category::getAllAdInSubCategory($slug, $subSlug); //get all ads in subcategory
        $subCats = Category::getAllSubCats($slug); //get other subcats in parent    
        return view('categories.subcat_ads', compact('ads', 'subCats'));    
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
