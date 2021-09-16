@extends("layouts.auth_master")
@section("title", "playlist")

@section("bodyContent") 
@include('medias.ajax.playlist_categories')
@stop

