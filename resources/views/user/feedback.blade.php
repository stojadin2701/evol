@extends('layouts.app')

@section('header')
  <link href="/css/register.css" rel="stylesheet">
@endsection

@section('content')

  <div class="container">

    <legend>Give us feedback!</legend>

    <div id="suggestionBttn" class="col-md-4">
      <button class="btn btn-lg btn-primary btn-block" onclick="displayForm('suggestion')">Make a suggestion</button>
    </div>

    <div id="eventBttn" class="col-md-4">
      <button class="btn btn-lg btn-primary btn-block" onclick="displayForm('event')">Report an event</button>
    </div>

    <div id="userBttn" class="col-md-4">
      <button class="btn btn-lg btn-primary btn-block" onclick="displayForm('user')">Report a user</button>
    </div>

    <div id="suggestion" style="display: none;">
      <form name="suggestion_form" class="form-horizontal" action="/feedback/Suggestion" method="post">
        {{ csrf_field() }}
        <fieldset>
          <div class="form-group">
            <label class="col-md-4 control-label">Write a suggestion</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <textarea class="form-control" name="content" placeholder="Your suggestions" required="true"></textarea>
              </div>
            </div>
          </div>
        </fieldset>
        <div  class="col-md-4"></div>
        <div class="col-md-4">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Send your feedback</button>
        </div>
      </form>
    </div>

    <div id="event" style="display: none;">
      <form name="event_form" class="form-horizontal" action="/feedback/Event" method="post">
        {{ csrf_field() }}
        <fieldset>
          <div class="form-group">
            <label class="col-md-4 control-label" >Event URL</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input name="url" id="inputEventURL" class="form-control" placeholder="Event URL" required="true">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Reason</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <textarea class="form-control" name="content" placeholder="Why do you think this event is inappropriate?" required="true"></textarea>
              </div>
            </div>
          </div>
        </fieldset>
        <div  class="col-md-4"></div>
        <div class="col-md-4">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Send your feedback</button>
        </div>
      </form>
    </div>

    <div id="user" style="display: none;">
      <form name="user_form" class="form-horizontal" action="/feedback/User" method="post">
        {{ csrf_field() }}
        <fieldset>
          <div class="form-group">
            <label class="col-md-4 control-label" >User URL</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input name="url" id="inputUserURL" class="form-control" placeholder="User URL" required="true">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Reason</label>
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                <textarea class="form-control" name="content" placeholder="Why do you think this user has behaved inappropriately?" required="true"></textarea>
              </div>
            </div>
          </div>
        </fieldset>
        <div  class="col-md-4"></div>
        <div class="col-md-4">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Send your feedback</button>
        </div>
      </form>
    </div>

  </div>
  <script src="js/feedback.js"></script>
@endsection
