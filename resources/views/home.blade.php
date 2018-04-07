@extends('layouts.app')

@section('content')
    <div class="row justify-content-center py-4">
        <div class="col-md-8">
            <div id="headlines" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    @foreach($headlines as $index => $headline)
                      <li data-target="#headlines" data-slide-to="{{$index}}"
                          class="{{$index===0?'active':''}}"></li>
                    @endforeach
                </ul>

                <div class="carousel-inner">
                    @foreach($headlines as $index => $headline)
                    <div class="carousel-item {{$index===0?'active':''}}">
                      <img class="img-fluid" src="{{$headline->image}}" alt="{{$headline->title}}">
                    </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#headlines" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#headlines" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="jumbotron home-jumpbotron">
        <div class="container">
            <h1>习题册</h1>
            <p>Just do it</p>
        </div>
    </div>
    <div class="jumbotron home-jumpbotron">
        <div class="container">
            <h1>试卷套题</h1>
            <p>Just do it</p>
        </div>
    </div>
    <div class="jumbotron home-jumpbotron">
        <div class="container">
            <h1>大题必背</h1>
            <p>Just do it</p>
        </div>
    </div>
@endsection
