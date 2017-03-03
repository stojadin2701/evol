@extends('layouts.app')

@section('header')
    <link href="/css/gridEvents.css" rel="stylesheet">
    <link href="/css/home.css" rel="stylesheet">
    <link href="css/shared.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">

    <a href="../event/create"><button class="btn btn-primary">Create a new Event</button></a>
    <br>
    <h3>Overview</h3>
    <p>On this page you can see events that you've created as well as events that you've participated in or are going to take part in. Past events are marked by transparent images.</p>
    <h3>My Events</h3>
    @foreach(array_chunk($myEvents->all(), 3) as $row)
        <div class="row">
            @foreach($row as $event)
                <div id="event{{$event->id}}" class="col-sm-4 col-lg-4 col-md-4">
                  <div class="profile-pic">
                    @if(!$event->isFinished())
                      <div class="thumbnail">
                    @else
                      <div class="thumbnail past">
                    @endif
                        <img src="{{ $event->imgPATH() }}" alt="" style="width: 290px; height: 170px;">
                        <div class="caption">
                            <h4>
                                <a href="{{ $event->path() }}">{{ $event->name }}</a>
                            </h4>
                            <p>{{ $event->summary }}</p>
                        </div>
                        <div class="date_and_comments">
                            <p class="pull-right">{{$event->comments->count()}} comment(s)</p>
                            <p>
                                {{date('d\.m\.Y', strtotime($event->dateTimeFrom))}}
                            </p>
                        </div>
                    </div>
                    <div class="keep-track"><a href="event/{{$event->id}}/track"><i class="fa fa-child fa-lg"></i></a></div>
                    @if($event->isOpenForSignUp())
                      <div class="edit"><a href="event/{{$event->id}}/edit"><i class="fa fa-pencil-square-o fa-lg"></i></a></div>
                      <div class="delete"><a id="delete-event" href="event/{{$event->id}}/delete"><i class="fa fa-trash-o fa-lg"></i></a></div>
                    @endif
                  </div>
                </div>
            @endforeach
        </div>
    @endforeach
    <h3>Others' Events</h3>
    @foreach (array_chunk($othersEvents->all(), 3) as $row)
      <div class="row">
        @foreach ($row as $event)
          <div class="col-sm-4 col-lg-4 col-md-4">
            @if($event->isOpenForSignUp())
              <div class="thumbnail">
            @else
              <div class="thumbnail past">
            @endif
                  <img src="{{ $event->imgPATH() }}" alt="" style="width: 290px; height: 170px;">
                  <div class="caption">
                      <h4>
                          <a href="{{ $event->path() }}">{{ $event->name }}</a>
                      </h4>
                      <p>{{ $event->summary }}</p>
                  </div>
                  <div class="date_and_comments">
                      <p class="pull-right">{{$event->comments->count()}} comment(s)</p>
                      <p>
                          {{date('d\.m\.Y', strtotime($event->dateTimeFrom))}}
                      </p>
                  </div>
              </div>
          </div>
        @endforeach
      </div>
    @endforeach
</div> <!-- /.container -->
@stop
