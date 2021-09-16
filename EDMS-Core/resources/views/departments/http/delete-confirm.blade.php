@extends("layouts.master")
@section("title", "delete")

@section("bodyContent") 
@include('departments.ajax.delete-confirm')
@stop