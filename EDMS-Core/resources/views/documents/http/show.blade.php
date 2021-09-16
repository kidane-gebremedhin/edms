@extends("layouts.master")
@section("title", "show document")

@section("bodyContent") 
@include('documents.ajax.show')
@stop

