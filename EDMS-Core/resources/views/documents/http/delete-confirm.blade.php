@extends("layouts.master")
@section("title", "delete document")

@section("bodyContent") 
@include('documents.ajax.delete-confirm')
@stop