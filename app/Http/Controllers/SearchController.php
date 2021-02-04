<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request) {
    	$ads = DB::table('ads')
    		->where('city_slug', $request->sCity)
    		->where('category_slug', $request->sCat)
    		->whereBetween('price', [$request->ot, $request->do])
    		->paginate(30);
    	
    	return view('search', compact('ads'));
    }
}
