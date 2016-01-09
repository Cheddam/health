<!DOCTYPE html>
<html lang="en-nz">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Back - HealthClub</title>
	
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/base-min.css">
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link rel="stylesheet" href="/css/health.css">
	@yield('css')
</head>
<body>
	@include('back.partials.nav')

	<div id="content">
		@yield('content')
	</div>

	@yield('js')
</body>
</html>