<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;

class Category extends Model
{
    use HasFactory;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    protected $table = "categories";

    protected $fillable = ['name', 'slug', 'description'];

    public function ads() {
    	return $this->belongsTo(Ad::class);
    }

    public static function getCities($region) {
        $cities = DB::table('regions')
            ->join('cities', 'cities.region_slug', 'regions.slug')
            ->where('cities.region_slug', $region)
            ->get();
        return $cities;    
    }

    public static function getCitiesAds($region) {
        $ads = DB::table('regions')
            ->join('cities', 'cities.region_slug', 'regions.slug')
            ->join('ads', 'ads.city_slug', 'cities.slug')
            ->where('cities.region_slug', $region)
            ->where('ads.status', Ad::ACTIVE)
            ->get();
        return $ads;    
    }

    public static function getCategoryInCity($region, $city) {
        $cityAds = DB::table('ads')
            ->join('cities', 'cities.slug', 'ads.city_slug')
            ->join('regions', 'regions.slug', 'cities.region_slug')
            ->where('regions.slug', $region)
            ->where('cities.slug', $city)
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
        return $cityAds;    
    }

    public static function getAdsInCity($city) {
        $ads = DB::table('ads')
            ->where('city_slug', $city) 
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
        return $ads;    
    }

    public static function getAdsInCategory($city, $category) {
        $ads = DB::table('ads')
            ->where('city_slug', $city) 
            ->where('category_slug', $category)
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
        return $ads;    
    }

    public static function getAllAdsInCategory($slug) {
        $ads = DB::table('ads')
            ->where('category_slug', $slug)   
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
        return $ads;    
    }

    public static function getSubCatsInCategory($slug) {
        $subCats = DB::table('categories')
            ->where('categories.parent_slug', $slug)
            ->get();
        return $subCats;    
    }

    public static function getAllAdInSubCategory($slug, $subSlug) {
        $ads = DB::table('ads')
            ->where('category_slug', $slug)  
            ->where('category_subslug', $subSlug)  
            ->where('ads.status', Ad::ACTIVE)
            ->get(); 
        return $ads;    
    }

    public static function getAllSubCats($slug) {
        $subCats = DB::table('categories')
            ->where('categories.parent_slug', $slug)
            ->get(); 
        return $subCats;    
    }
}
