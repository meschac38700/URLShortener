@extends('../layouts.master')

@section('title',"Home - URL Shortener")
@section('h1', "Welcome to our best URL Shortener application")

@section('header')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@stop()
@section('content')

	<div class="content">
		<form method="post">
			{{ csrf_field() }}
			{!!$errors->first('message', '<p class="error-msg">:message</p>')!!}
			<input type="text" name="url"  placeholder="Enter your url ..." value="{{ ($errors->first('bad_url'))?$errors->first('bad_url'):"" }}">
			<input type="submit" value="Short url">
		</form>
	</div>

@stop()

@push('script_footer')

@section('footer')
&copy; TDN TP 2018
@stop()

<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
@endpush()
