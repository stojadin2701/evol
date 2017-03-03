@extends('layouts.app')

@section('header')
  <link href="/css/event.css" rel="stylesheet">
@endsection

@section('content')
  <!-- Page Content -->
  <div class="container">
    <div class="resume">
        <header align="center" class="page-header">
            <h1 class="page-title">{{ $event->name }}</h1>
        </header>
        <div class="row">
            <div class="col-md-10 col-lg-offset-1">
              <div class="panel panel-default">
                <div class="panel-heading resume-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <figure>
                              <div class="row carousel-holder">
                                  <div class="col-md-6">
                                      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                          <ol class="carousel-indicators">
                                              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                              @for($i = 1; $i < $event->images()->count(); $i++)
                                                <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                                              @endfor
                                          </ol>
                                          <div class="carousel-inner">
                                              @if($event->images()->count() == 0)
                                                <div class="item active">
                                                    <img class="slide-image" src="/img/events/default_event.png" alt="">
                                                </div>
                                              @else
                                                @php
                                                  $i = 0;
                                                  foreach($event->images()->get() as $image)
                                                  {
                                                    echo "<div" . PHP_EOL;
                                                    if($i == 0)
                                                      echo "class='item active'" . PHP_EOL;
                                                    else
                                                      echo "class='item'" . PHP_EOL;
                                                    echo ">" . PHP_EOL;
                                                    echo "<img class='slide-image' src='/" . $image->uri . "' alt=''>" . PHP_EOL;
                                                    echo "</div>" . PHP_EOL;
                                                    $i++;
                                                  }
                                                @endphp
                                              @endif
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
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-center">Volunteers applied:</h4>
                            <div class="progress">
                                <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="{{ $progressBarFill }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progressBarFill }}%;" data-placement="top">
                                    <span id="progressBarProgress" class="progress-type">{{ $event->participantsApplied }}</span>
                                </div>
                            </div>
                            <div class="progress-meter">
                                <div class="meter meter-left" style="width: {{ $percentNeeded }}%;"><span class="meter-text"><font color="red">Insufficient</font></span></div>
                                <div class="meter meter-left" style="width: 0%;"><span class="meter-text"><font color="#P00FF00">Enough</font></span></div>
                                <div class="meter meter-right" style="width: 30%;"><span class="meter-text"><span style="color:#ff0000;">A</span><span style="color:#ff7f00;">w</span><span style="color:#ffff00;">e</span><span style="color:#80ff00;">s</span><span style="color:#00ff00;">o</span><span style="color:#00ffff;">m</span><span style="color:#0000ff;">e</span><span style="color:#8b00ff;">!</span></span></div>
                            </div>
                            <br><br>
                            @if(Auth::check() && (Auth::user()->id != $event->organizer->id) && $event->isOpenForSignUp())
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <script>
                                  function signUp() {
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                      if (xhttp.readyState == 4 && xhttp.status == 200) {
                                       var newProgress = xhttp.responseText;

                                       var progressBar = document.getElementById("progressBar");
                                       progressBar.setAttribute("aria-valuenow", newProgress);
                                       progressBar.setAttribute("style", "width: " + newProgress + "%;");

                                       var progressBarProgress = document.getElementById("progressBarProgress");
                                       progressBarProgress.innerHTML++;

                                       var signupButton = document.getElementById("signupButton");
                                       signupButton.setAttribute("class", "btn btn-warning");
                                       signupButton.setAttribute("value", "OptOut");
                                       signupButton.innerHTML = "Opt Out";
                                       signupButton.setAttribute("onclick", "optOut()");
                                      }
                                    };
                                    xhttp.open("GET", "/event/{{ $event->id }}/signup", true);
                                    xhttp.send();
                                  }

                                  function optOut()
                                  {
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                      if (xhttp.readyState == 4 && xhttp.status == 200) {
                                       var newProgress = xhttp.responseText;

                                       var progressBar = document.getElementById("progressBar");
                                       progressBar.setAttribute("aria-valuenow", newProgress);
                                       progressBar.setAttribute("style", "width: " + newProgress + "%;");

                                       var progressBarProgress = document.getElementById("progressBarProgress");
                                       progressBarProgress.innerHTML--;

                                       var signupButton = document.getElementById("signupButton");
                                       signupButton.setAttribute("class", "btn btn-primary");
                                       signupButton.setAttribute("value", "SignUp");
                                       signupButton.innerHTML = "Sign Up";
                                       signupButton.setAttribute("onclick", "signUp()");
                                      }
                                    };
                                    xhttp.open("GET", "/event/{{ $event->id }}/optout", true);
                                    xhttp.send();
                                  }
                                </script>
                                @if(!in_array(Auth::user()->id, $signedUpUsersIds))
                                  <button id="signupButton" name="mySignUpButton" type="button" class="btn btn-primary" onclick="signUp()" value="SignUp">Sign Up</button>
                                @else
                                  <button id="signupButton" name="mySignUpButton" type="button" class="btn btn-warning" onclick="optOut()" value="OptOut">Opt Out</button>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="bs-callout bs-callout-danger">
                    <h4>Organizer</h4>
                    <br>
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="thumbnail">
                                <a href="{{ $event->organizer->path() }}"><img class="img-responsive user-photo" style= "max-width:100%;max-height:100%;" src="{{ $event->organizer->getImageURI() }}"></a>
                            </div>
                        </div>

                        <a href="{{ $event->organizer->path() }}" style="font-size:1.5em;">{{ $event->organizer->username }}</a>

                    </div>
                    <hr>
                    <h4>Categories</h4>
                    <ul>
                    @foreach($event->categories as $category)
                      <li>
                          {{ $category->name }}
                      </li>
                    @endforeach
                    </ul>
                    <hr>
                    <h4>Time</h4>
                    <p>
                        {{ $event->dateFormatFrom() . ' - ' . $event->dateFormatTo() }}
                    </p>
                    <hr>
                    <h4>Location</h4>
                    <p>
                        {{ $event->location }}
                    </p>
                    <hr>
                    <h4>Description</h4>
                    <p>
                        {{ $event->description }}
                    </p>
                </div>
              </div>
            </div>
        </div>
        @if(Auth::check() && ($event->organizer->id == Auth::user()->id))
          <a href="{{$event->id}}/track"><button class="btn btn-primary col-lg-offset-5">Keep track of participants</button></a>
        @endif
    </div>
    <div name="comments" class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-1">
                <h4>Comments</h4>
            </div>
            <!-- /col-sm-12 -->
        </div>

        @foreach($comments as $comment)
          <!-- /row -->
          <div class="row">
              <!-- /col-sm-5 -->
              <div class="col-sm-1 col-sm-offset-1">
                  <div class="thumbnail">
                      <img class="img-responsive user-photo" src="{{ $comment->author->getImageURI() }}">
                  </div>
                  <!-- /thumbnail -->
              </div>
              <!-- /col-sm-1 -->
              <div class="col-sm-5">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <strong><a href="/user/{{ $comment->author->id }}">{{ $comment->author->username }}</a></strong> <span class="text-muted">commented at {{ $comment->updated_at }}</span>
                      </div>
                      <div class="panel-body">
                          {{ $comment->text }}
                      </div>
                      <!-- /panel-body -->
                  </div>
                  <!-- /panel panel-default -->
              </div>
              <!-- /col-sm-5 -->
          </div>
        @endforeach

        {!! $comments->render() !!}

        @if(Auth::check())
          <hr>
          <div class="row">
            <div class="col-sm-1 col-sm-offset-1">
                <div class="thumbnail">
                    <img class="img-responsive user-photo" src="{{ Auth::user()->getImageURI() }}">
                </div>
                <!-- /thumbnail -->
            </div>
            <div class="col-sm-5">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <span>Comment something about this event...</span>
                </div>
                <div class="panel-body">
                  <form method="post" action="{{ url('event/'.$event->id) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <textarea name="comment" rows="3" cols=54 style="resize:vertical" required="true" placeholder="Write a comment..."></textarea>
                    </div>
                      <button name='addComment' type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Comment
                      </button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        @endif

      </div>
      <!-- /container -->
  </div>
    <!-- Custom JavaScript -->
  <script src="/js/event.js"></script>
@endsection
