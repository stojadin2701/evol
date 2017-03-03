@extends('layouts.app')

@section('header')
  <link href="/css/create_event.css" rel="stylesheet">
  <link href="/css/keep_track.css" rel="stylesheet">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
@endsection

@section('content')
  <div class="container">
    @if ($event->isOpenForSignUp())
      <blockquote class="blockquote" align="center">
        <p class="text-primary" style="font-size: 36px">You can keep track of the participants once the event starts!</p>
      </blockquote>
    @else
      <div class="form-group text-center">
          <h3><a href = "/event/{{ $event->id }}">{{ $event->name }}</a></h3>
          <h2>Untracked participants</h2>
      </div>

      @foreach($untrackedParticipants as $participant)
        <form method="POST" action="/event/{{$event->id}}/track/{{$participant->id}}">
          {{ csrf_field() }}
          <div class="row" id="paricipant{{$participant->id}}">
              <div class="col-sm-1 col-sm-offset-1">
                  <div class="thumbnail">
                      <img class="img-responsive user-photo" src="{{ $participant->getImageURI() }}">
                  </div>

              </div>

              <div class="col-sm-8">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <strong><a href="user/{{$participant->id}}">{{$participant->username}}</a></strong> &nbsp;
                          <div class="stars">
                            <input class="star star-5" id="star-5" type="radio" name="star" value=5/>
                            <label class="star star-5" for="star-5"></label>
                            <input class="star star-4" id="star-4" type="radio" name="star" value=4/>
                            <label class="star star-4" for="star-4"></label>
                            <input class="star star-3" id="star-3" type="radio" name="star" value=3/>
                            <label class="star star-3" for="star-3"></label>
                            <input class="star star-2" id="star-2" type="radio" name="star" value=2/>
                            <label class="star star-2" for="star-2"></label>
                            <input class="star star-1" id="star-1" type="radio" name="star" value=1/>
                            <label class="star star-1" for="star-1"></label>
                          </div>
                          @if ($errors->has('star'))
                          <span class="help-block">
                                <strong>{{ $errors->first('star') }}</strong>
                          </span>
                          @endif
                          <span class="check"> <button class="btn-link" type = "submit" name="track" value="check"><i class="fa fa-check fa-2x"></i></button></span>
                          <span class="not-present"><button class="btn-link" type = "submit" name="track" value="uncheck"><i class="fa fa-times fa-2x"></i></button></span>
                      </div>
                      <div class="col-sm-13">
                          <textarea type="text"  style="resize:vertical" class="form-control" id="location" name="note" placeholder="Write something about {{$participant->username}}'s involvement" value=""></textarea>
                          @if ($errors->has('note'))
                          <span class="help-block">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $errors->first('note') }}</strong>
                          </span>
                          @endif
                      </div>

                  </div>
              </div>
          </div>
        </form>
      @endforeach
    @endif



    <!--  <div class="row" id="participant1">
          <div class="col-sm-1 col-sm-offset-1">
              <div class="thumbnail">
                  <img class="img-responsive user-photo" src="/img/default_user.png">
              </div>

          </div>

          <div class="col-sm-8">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <strong><a href="user.html">Stojadin2701</a></strong> &nbsp; <span id="stars" class="starrr"></span>
                      <span class="check"><a class="check-participant" href="#" onclick="checkParticipant('participant1')"><i class="fa fa-check fa-2x"></i></a></span>
                      <span class="not-present"><a class="check-participant" href="#" onclick="checkParticipant('participant1')"><i class="fa fa-times fa-2x"></i></a></span>
                  </div>
                  <div class="col-sm-13">
                      <input type="text" class="form-control" id="location" name="location" placeholder="Write something about this participant's involvement" value="">
                  </div>
              </div>

          </div>
      </div>

      <div class="row" id="participant2">
          <div class="col-sm-1 col-sm-offset-1">
              <div class="thumbnail">
                  <img class="img-responsive user-photo" src="/img/default_user.png">
              </div>

          </div>

          <div class="col-sm-8">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <strong><a href="user.html">Ana Peško</a></strong> &nbsp; <span id="stars" class="starrr"></span>
                      <span class="check"><a class="check-participant" href="#" onclick="checkParticipant('participant2')"><i class="fa fa-check fa-2x"></i></a></span>
                      <span class="not-present"><a class="check-participant" href="#" onclick="checkParticipant('participant2')"><i class="fa fa-times fa-2x"></i></a></span>
                  </div>
                  <div class="col-sm-13">
                      <input type="text" class="form-control" id="location" name="location" placeholder="Write something about this participant's involvement" value="">
                  </div>
              </div>

          </div>
      </div>

      <div class="row" id="participant3">
          <div class="col-sm-1 col-sm-offset-1">
              <div class="thumbnail">
                  <img class="img-responsive user-photo" src="/img/default_user.png">
              </div>

          </div>

          <div class="col-sm-8">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <strong><a href="user.html">VladaCat</a></strong> &nbsp; <span id="stars" class="starrr"></span>
                      <span class="check"><a class="check-participant" href="#" onclick="checkParticipant('participant3')"><i class="fa fa-check fa-2x"></i></a></span>
                      <span class="not-present"><a class="check-participant" href="#" onclick="checkParticipant('participant3')"><i class="fa fa-times fa-2x"></i></a></span>
                  </div>
                  <div class="col-sm-13">
                      <input type="text" class="form-control" id="location" name="location" placeholder="Write something about this participant's involvement" value="">
                  </div>
              </div>

          </div>
      </div>

      <div class="row" id="participant4">
          <div class="col-sm-1 col-sm-offset-1">
              <div class="thumbnail">
                  <img class="img-responsive user-photo" src="/img/default_user.png">
              </div>

          </div>

          <div class="col-sm-8">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <strong><a href="user.html">BajicSmarac1337</a></strong> &nbsp; <span id="stars" class="starrr"></span>
                      <span class="check"><a class="check-participant" href="#" onclick="checkParticipant('participant4')"><i class="fa fa-check fa-2x"></i></a></span>
                      <span class="not-present"><a class="check-participant" href="#" onclick="checkParticipant('participant4')"><i class="fa fa-times fa-2x"></i></a></span>
                  </div>
                  <div class="col-sm-13">
                      <input type="text" class="form-control" id="location" name="location" placeholder="Write something about this participant's involvement" value="">
                  </div>
              </div>

          </div>
      </div>
    -->
  </div>
@endsection
