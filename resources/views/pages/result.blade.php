@extends('../layouts.master')
@section('title', "URL-Shortened")
@section('h1', "Here, your url shortened")
@section('content')

	<a target="_blank" href="{!! config('app.url')."/". $urlShortened!!}">{!! config('app.url')."/". $urlShortened!!}</a>

@stop()