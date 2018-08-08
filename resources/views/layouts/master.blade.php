<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	@yield('header')
	<style type="text/css">
		.content
		{
			
		}
		.error-msg{
			color: #ff0000;
		}
	</style>
</head>
<body>
	<h1>@yield('h1')</h1>
	@yield('content')
	<footer>
		@yield('footer')
	</footer>

	@stack('script_footer')
	
</body>
</html>