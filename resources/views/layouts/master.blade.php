<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	@yield('header')
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
</head>
<body>
	<div class="wrapper">
		<h1>@yield('h1')</h1>
		@yield('content')
	</div>
	<footer>
		@yield('footer')
	</footer>

	@stack('script_footer')
	
</body>
</html>