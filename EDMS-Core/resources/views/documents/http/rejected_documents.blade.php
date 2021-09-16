@extends("layouts.master")

@section('title', 'rejected documents')

@section("bodyContent") 

@include('documents.ajax.rejected_documents')

@stop
