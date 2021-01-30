@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

            @foreach($cityAndCat as $cat)
            <div class="col">
                <div class="card shadow-sm">
                
                <a href="#" style="text-decoration: none; color:black;">
                <div class="">
                    <div style="height:200px; background-size: cover; background-image: url({{$cat->photo}})"></div>
                    <a href="{{ route('sSlug', ['slug' => $cat->slug]) }}">
                        <h5 class="ml-1 card-text">{{$cat->title}}</h5>
                    </a>
                    <h6 class="ml-1 card-text">{{$cat->price}} rubles</h6>
                    <small class="ml-1">publiched: {{$cat->created_at->diffForHumans()}}</small>
                </div>
                </a>    

                </div>
            </div>    
            @endforeach
                 
        </div>
    </div>
</div>
@endsection