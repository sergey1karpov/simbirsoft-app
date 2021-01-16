@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            
            
            @foreach($ads as $ad)
            <div class="col">
                <div class="card shadow-sm">
                

                <div class="">
                    <div style="height:200px; background-size: cover; background-image: url({{$ad->photo}})"></div>
                    <p class="card-text">{{$ad->title}}</p>
                    <p class="card-text"><h6>{{$ad->price}} rubles</h6></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('show', $ad->slug) }}">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>    
            @endforeach
            

              
        </div>
    </div>
</div>
@endsection