<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Elasticsearch\ClientBuilder;

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

    // public function esSearch() {
    // 	$client = ClientBuilder::create()->setHosts(['172.20.0.1:9200'])->build();
    	
    //     $params = [
    //         'index' => 'my_index',
    //         'id' => 'test_id',
    //         'body' => ['testField' => 'abc']
    //     ];

    //     $result = $client->index($params);
    //     var_dump($result);
    // }
}
