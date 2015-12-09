<!DOCTYPE html>
<html lang="en-nz">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $title or 'Yo' }} - Health</title>
	
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/base-min.css">
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link rel="stylesheet" href="/css/health.css">
	@yield('css')
</head>
<body>
	@include('partials.nav')

	@yield('content')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/redux/3.0.4/redux.js"></script>
	<script src="https://fb.me/react-0.14.2.js"></script>
	<script src="https://fb.me/react-dom-0.14.2.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="/js/all.js"></script>
	@yield('js')
</body>
</html>