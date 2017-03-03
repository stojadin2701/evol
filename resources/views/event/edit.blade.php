@extends('layouts.app')

@section('header')
  <link href="/css/create_event.css" rel="stylesheet">
  <script type="text/javascript" src="/js/multiupload.js"></script>
  <script type="text/javascript" src="/js/edit.blade.php.js"></script>
@endsection

@section('content')
<!-- Page Content -->
<div class="container">
    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="post" action="{{ url('event/' . $content['event_id'] . '/edit') }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group text-center">
            <h2>Edit event</h2>
        </div>
        @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger col-sm-8 col-sm-offset-2">
                <ul>
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="title" name="title" placeholder="Event title" value="{{ $content['title'] }}">
            </div>
        </div>
        <div class="form-group">
            <label for="picture" class="col-sm-2 control-label">Pictures (Max 5)</label>
            <div class="col-sm-8" name="uploadform" id="uploadform">
              <!--input id="picture" name="picture" type="file" class="file form-control" data-show-preview="true"-->
              <input type="hidden" id="markedImages" name="markedImages" value="">
              @foreach($content['images'] as $image)
                  <img src="/{{ $image->uri }}" width="100"/>
                  <input id="{{ $image->uri }}" type="button" onclick="markForDeletion('{{ $image->uri }}')" value="Delete"/>
              @endforeach
              <script>
                  upload = new adekMultiUpload('uploadform',
                  {{ 5 - count($content['images']) }},
                  [ ".jpg", ".png", ".gif" ], 'picture');
                  upload.init();
              </script>
            </div>
        </div>
        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">Categories</label>
            <div class="col-sm-8">
                <select multiple class="form-control" id="categories[]" name="categories[]">
                    @foreach($content['all_categories'] as $category)
                      <option
                      @if(in_array($category->name, $content['categories_names']))
                        selected
                      @endif
                      >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="dateFrom" class="col-sm-1 col-sm-offset-1 control-label">From</label>
            <div class='col-sm-3'>
                <input required type='datetime-local' id="dateFrom" name="dateFrom" class="form-control" placeholder="When does the event start" value="{{ $content['dateFrom'] }}"/>
            </div>
            <label for="dateTo" class="col-sm-1 col-sm-offset-1 control-label">To</label>
            <div class="col-sm-3">
                <input required type='datetime-local' id="dateTo" name="dateTo" class="form-control" placeholder="When does the event end" value="{{ $content['dateTo'] }}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="location" class="col-sm-2 control-label">Location</label>
            <div class="col-sm-8">
                <input required type="text" class="form-control" id="location" name="location" placeholder="Where is the event taking place" value="{{ $content['location'] }}">
            </div>
        </div>
        <div class="form-group">
            <label for="summary" class="col-sm-2 control-label">Summary</label>
            <div class="col-sm-8">
                <textarea required class="form-control" style="resize:none" rows="2" id="summary" name="summary" placeholder="Short event summary">{{ $content['summary'] }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-8">
                <textarea required class="form-control" style="resize:none" rows="12" id="description" name="description" placeholder="What's the event about, details and organization">{{ $content['description'] }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="participantsNeeded" class="col-sm-2 control-label">Participants Needed</label>
            <div class="col-sm-8">
                <input required type="number" class="form-control" rows="12" id="participantsNeeded" name="participantsNeeded" placeholder="Minimum amount of participants for the event to take place." value="{{ $content['participantsNeeded'] }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button name="edit" type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                <! Will be used to display an alert to the user>
            </div>
        </div>
    </form>
</div>
@endsection
