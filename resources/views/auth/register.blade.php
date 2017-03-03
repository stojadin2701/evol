@extends('layouts.app')
@section('header')
<link href="css/register.css" rel="stylesheet">
<link href="css/shared.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="containter">

                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 1.5em;"><center><b>Register</b></center></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Username*</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                                    </div>
                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                                  <strong>{{ $errors->first('username') }}</strong>
                                              </span> @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail*</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="email" type="email" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}">
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                                  <strong>{{ $errors->first('email') }}</strong>
                                              </span> @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password*</label>

                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                                  <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password*</label>

                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password-confirm" type="password" placeholder="Password (Confirm)" class="form-control" name="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span> @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Full Name</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="name" type="text" class="form-control" placeholder="Full Name" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">City</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                        <input id="city" type="text" class="form-control" placeholder="City" name="city" value="{{ old('city') }}">

                                    </div>
                                    @if ($errors->has('city'))
                                    <span class="help-block">
                                          <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                     @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Short Bio</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                        <textarea style="resize:vertical" rows=5 id="bio" type="text" class="form-control" placeholder="Write something about yourself..." name="bio" value="{{ old('short_bio') }}"></textarea>
                                    </div>
                                    @if ($errors->has('bio'))
                                    <span class="help-block">
                                          <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" name="register">
                                        <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Register
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
