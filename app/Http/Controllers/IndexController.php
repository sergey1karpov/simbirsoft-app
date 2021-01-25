<?php

namespace App\Http\Controllers;
use App\Models\Ad;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() 
    {
    	$ads = Ad::where('status', Ad::ACTIVE)->get();
    	return view('index', compact('ads'));
    }

    public function show($slug)
    {
    	$ad = Ad::where('slug', $slug)->firstOrFail();
    	return view('ad', compact('ad'));
    }
}
