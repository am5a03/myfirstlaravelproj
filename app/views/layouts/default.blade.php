<!doctype html>
<html>
<head>
	@include('includes.head')
</head>
<body>
	@include('includes.facebookscript')
<div class="container">

	<header class="row">
		@include('includes.header')
	</header>
	<div id="blank" style="display:block; height: 50px"></div>
	@if (Session::get('messages'))
	<div class="alert alert-success">{{ Session::get('messages') }}</div>
	@endif
	<div id="main" class="row">

			@yield('content')

	</div>

	<footer class="row">
		@include('includes.footer')
	</footer>

</div>
</body>
</html>