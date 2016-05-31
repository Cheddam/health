<!DOCTYPE html>
<html lang="en-nz">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>healthclub</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<link rel="stylesheet" href="/css/vendor/pure-base.css">
	<link rel="stylesheet" href="/css/vendor/pure-main.css">
	<link rel="stylesheet" href="/css/health.css">
	@yield('css')
</head>
<body>
	@include('front.partials.nav')

	@include('front.partials.messages')

	<div id="content">
		@yield('content')
	</div>

	@yield('js')
</body>
</html>