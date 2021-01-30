@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-5">
            <div class="col-12">
                <ul class="list-group list-group-horizontal">
                    @foreach($cityAds as $cityAd)
                        @foreach($cityAd->categories as $cat)
                        <a href="{{ route('sCat', ['city' => $cityAd->city_slug, 'category' => $cityAd->category_slug]) }}">
                            <li class="list-group-item">{{$cat->name}}</li>
                        </a>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            @foreach($cityAds as $cityAd)
            <div class="col">
                <div class="card shadow-sm">
                
                <a href="#" style="text-decoration: none; color:black;">
                <div class="">
                    <div style="height:200px; background-size: cover; background-image: url({{$cityAd->photo}})"></div>
                    <a href="{{ route('sSlug', ['slug' => $cityAd->slug]) }}">
                        <h5 class="ml-1 card-text">{{$cityAd->title}}</h5>
                    </a>
                    <h6 class="ml-1 card-text">{{$cityAd->price}} rubles</h6>
                    <small class="ml-1">publiched: {{$cityAd->created_at->diffForHumans()}}</small>
                </div>
                </a>    

                </div>
            </div>    
            @endforeach
                 
        </div>
    </div>
</div>
@endsection