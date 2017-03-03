@extends('layouts.app')

@section('header')
    <link href="css/shared.css" rel="stylesheet">
    <link href="css/gridEvents.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

    <script src="js/index.js"></script>
    <script src="js/listgroup.min.js"></script>
@endsection

@section('content')
  <!-- Page Content -->
  <div class="container">
      <div class="row">

          @if ($carouselEvents->count() > 0)
          <div class="col-md-10 col-md-offset-1">
              <div class="row carousel-holder">
                  <div class="col-md-12">
                      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                              @foreach($carouselEvents as $i=>$event)
                                  <li class="carouselIndicator" data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                              @endforeach
                          </ol>
                          <div class="carousel-inner">
                              @foreach($carouselEvents as $event)
                              <div class="item carouselItem">
                                  <a href="{{ $event->path() }}">
                                      <img class="slide-image" src="{{ $event->imgPATH() }}" alt="" style="width:945px;height:440px;">
                                      <div class="carousel-caption">
                                          <h2>{{ $event->name }}</h2>
                                      </div>
                                  </a>
                              </div>
                              @endforeach
                          </div>
                          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                          </a>
                          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                          </a>
                      </div>
                  </div>
              </div>
              @endif

              @foreach(array_chunk($events->getCollection()->all(), 3) as $row)
                  <div class="row">
                      @foreach($row as $event)
                          <div class="col-sm-4 col-lg-4 col-md-4">
                              <div class="thumbnail">
                                  <img src="{{ $event->imgPATH() }}" alt="" style="width: 290px; height: 170px;">
                                  <div class="caption">
                                      <h4>
                                          <a href="{{ $event->path() }}">{{ $event->name }}</a>
                                      </h4>
                                      <p>{{ $event->summary }}</p>
                                  </div>
                                  <div class="date_and_comments">
                                      <p class="pull-right">{{$event->comments->count()}} comments</p>
                                      <p>
                                          {{date('d\.m\.Y', strtotime($event->dateTimeFrom))}}
                                      </p>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
              @endforeach

              <br>
              {!! $events->render() !!}
              </div>
          </div>
      </div>
  </div> <!-- /.container -->
@endsection
