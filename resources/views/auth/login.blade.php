@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 1.5em;"><center><b>Login</b></center></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}" required="true">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                              </div>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="login">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
