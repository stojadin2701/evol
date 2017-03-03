@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}">
@stop

@section('content')
<div class="container">
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Users</div>
        <div class="panel-body">
            <p>After selecting a user you can grant or take away moderator privileges.</p>
        </div>
        <!-- Search -->
        <input id="search-box" type="text" class="form-control search-input" placeholder="Search by username..." >

        <!-- List group -->
        <div class="list-group" id="search-results">

        </div>
    </div>
    <div class="text-center">
        <div class="btn-group-lg" role="group" aria-label="...">
            <button id="grant-button" type="button" class="btn btn-primary" onclick="changePrivileges('add')">Grant</button>
            <button id="deny-button" type="button" class="btn btn-danger" onclick="changePrivileges('remove')">Deny</button>
        </div>
    </div>
</div> <!-- /.container -->


<!-- Listgroup -->
<script type="text/javascript" src="{{ URL::asset('js/listgroup.js') }}"></script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}"></script>

@stop