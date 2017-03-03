@extends('layouts.app')

@section('header')
  <link href="/css/index.css" rel="stylesheet">
  <script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection

@section('content')
  <!-- Page Content -->
  <div class="container">

      <div class="media">
          <h3>User information</h3>
          <hr />
        <div class="col-md-3">

          <div class="media-left media-middle">

            @if($user->imgURI==null)
              <img class="media-object" src="/img/users/default_user.png" alt="User image" />
            @else
              <img class="media-object"src="/{{$user->imgURI}}"  style= "max-width:100%;max-height:100%;" alt="User image" />
            @endif
            @if(Auth::check() and Auth::user()->id==$user->id)
              <form enctype="multipart/form-data" method="post"  action="/user/{{$user->id}}/addUserImage">

                <div class="form-group">
                    {{ csrf_field() }}
                    <div class="col-sm-2">
                      <input id="picture"  name="picture" type="file" class="" accept="image/*" data-show-preview="true">
                    </div>
                </div>
                <br /><br />
                <div class="col-sm-8 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Upload image</button>
                </div>

              </form>
              @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="media-body"  style= "max-width:560px; max-height:350px">
            <ul class="list-group">
                            <li class="list-group-item">
                  <h4 class="media-heading">Username:</h4> {{$user->username}}
                            </li>
                            <li class="list-group-item">
                  <h4 class="media-heading">Contact:</h4> {{$user->email}}
                            </li>
                            <li class="list-group-item">
                  <h4 class="media-heading">Full name:</h4> {{$user->name}}
                            </li>
                            <li class="list-group-item">
                  <h4 class="media-heading">City:</h4> {{$user->city}}
                            </li>
                            <li class="list-group-item">
                  <h4 class="media-heading">Bio:</h4> {{$user->bio}}
                            </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          @if(Auth::check() and (Auth::user()->isAdmin() || Auth::user()->isMod()) and Auth::user()->id!=$user->id)
            @if(!$user->isBanned())
               <form class="text-center" method="post" action="/user/{{$user->id}}/toggleBan">
                 {{ csrf_field() }}

                 <div class="col-md-4 center-block">
                   <button type="submit" class="btn btn-danger center-block" >Ban User</button>
                 </div>
               </form>
            @else
              <form method="post" action="/user/{{$user->id}}/toggleBan">
                {{ csrf_field() }}
                <div class="col-md-4 center-block">
                    <button type="submit" class="btn btn-primary center-block">Unban User</button>
                </div>
              </form>
            @endif
           @endif
        </div>

      </div>
      <hr />
      <h3>Badges</h3>
      <div class="row">
        @foreach($badges as $badge)
          <div class="col-sm-3 col-lg-3 col-md-3">
              <div class="thumbnail">
                  <img data-toggle="tooltip" title="{{$badge->description}}" src="/{{$badge->icon}}" alt="">
                  <div align="center" class="caption">
                      <h4>
                          {{ $badge->name }}
                      </h4>
                  </div>
              </div>
            </div>
        @endforeach
      </div>
        <hr />
        <h3>Notes about {{ $user->username }}</h3>
          @foreach($participations as $participation)
            <div class="row">
              <div class="col-sm-5">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <strong>{{ $participation->pivot->user_rating }} star(s)</strong> <span class="text-muted">at <a href="/event/{{$participation->id}}">{{ $participation->name }}</a></span>
                      </div>
                      <div class="panel-body">
                          {{ $participation->pivot->note }}
                      </div>
                      <!-- /panel-body -->
                  </div>
                  <!-- /panel panel-default -->
              </div>
            </div>
          @endforeach
  </div> <!-- /.container -->
@endsection
