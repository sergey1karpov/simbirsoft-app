@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mb-5">
            <div class="col-12">
                <ul class="list-group list-group-horizontal">
                    @foreach($cityAds as $cityAd)
                        <a href="{{ route('sCat', ['region' => $cityAd->region_slug, 'city' => $cityAd->city_slug, 'category' => $cityAd->category_slug]) }}">
                            <li class="list-group-item">{{$cityAd->category_slug}}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            @foreach($ads as $ad)
            <div class="col">
                <div class="card shadow-sm">
                
                <a href="#" style="text-decoration: none; color:black;">
                <div class="">
                    <div style="height:200px; background-size: cover; background-image: url({{$ad->photo}})"></div>
                    <a href="{{ route('sSlug', ['slug' => $ad->slug]) }}">
                        <h5 class="ml-1 card-text">{{$ad->title}}</h5>
                    </a>
                    <h6 class="ml-1 card-text">{{$ad->price}} rubles</h6>
                    <small class="ml-1">publiched: {{$ad->created_at}}</small>
                </div>
                </a>    

                </div>
            </div>    
            @endforeach
                 
        </div>
    </div>
</div>
@endsection