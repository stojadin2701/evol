@extends('layouts.app')

@section('header')
  <link href="/css/gridEvents.css" rel="stylesheet">
  <link href="/css/mod.css" rel="stylesheet">
  <link href="/css/shared.css" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
      <h3>Events to review</h3>
      <div class="row">

        @foreach($events as $event)
          <div class="col-sm-4 col-lg-4 col-md-4">
              <div class="thumbnail" style="width: 290px">
                  <img src="{{ $event->imgPATH() }}" alt="" style="width: 290px; height: 170px;">
                  <div class="caption">
                      <h4>
                          <a href="{{ $event->path() }}">{{ $event->name }}</a>
                      </h4>
                      <div class="summary">
                          <p>
                              {{ $event->summary }}
                          </p>
                      </div>
                      <div class="approve"><a id="approve-event" href="#" onclick="approveEvent({{ $event->id }})"><i class="fa fa-check fa-2x"></i></a></div>
                      <div class="remove"><a id="delete-event" href="#" onclick="deleteEvent({{ $event->id }})"><i class="fa fa-times fa-2x"></i></a></div>
                  </div>
              </div>
          </div>
        @endforeach


      </div>
      <hr />
      <h3>User Feedback</h3>
      <div class="container">
        @foreach($feedbacks as $feedback)
          <!-- /row -->
          <div class="row" id="{{ "feedback".$feedback->id }}">
              <div class="col-sm-1 col-sm-offset-0">
                  <div class="thumbnail">
                      <img class="img-responsive user-photo" src="{{ $feedback->author->getImageURI() }}">
                  </div>
                  <!-- /thumbnail -->
              </div>
              <!-- /col-sm-1 -->
              <div class="col-sm-7">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <strong><a href="{{ $feedback->author->path() }}">{{ $feedback->author->name }}</a></strong>
                          <span class="text-muted">sent feedback on {{ $feedback->dateFormat() }}</span>
                          <span class="text-muted" id="category">{{ $feedback->category->name }}</span>
                      </div>
                      <div class="panel-body">
                          {{ $feedback->content }}
                          <div class="delete"><a id="delete-feedback" href="#" onclick="deleteFeedback({{ $feedback->id }})"><i class="fa fa-times fa-2x"></i></a></div>
                      </div>
                      <!-- /panel-body -->
                  </div>
                  <!-- /panel panel-default -->
              </div>
          </div>
        @endforeach
      </div>
  </div>

  <!-- Custom JavaScript -->
  <script type="text/javascript" src="{{ URL::asset('js/mod.js') }}"></script>
@endsection
