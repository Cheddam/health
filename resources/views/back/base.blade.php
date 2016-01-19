<!DOCTYPE html>
<html lang="en-nz">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Back - HealthClub</title>
	
	<link rel="stylesheet" href="/css/vendor/pure-base.css">
	<link rel="stylesheet" href="/css/vendor/pure-main.css">
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