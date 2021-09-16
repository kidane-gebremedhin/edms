@extends("layouts.master")
@section("title", "show shared document")

@section("bodyContent") 
@include('documents.ajax.show_shared_document')
@stop

