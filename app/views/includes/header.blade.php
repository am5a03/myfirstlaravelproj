<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<a class="navbar-brand" href="#">FIFA 2014!</a>
	<ul class="nav navbar-nav">
		<li><a href="/">Home</a></li>
		@if (!Auth::check())
			<li><a href="/login">Login</a></li>
		@else
			<li><a href="/logout">Logout</a></li>
		@endif
	</ul>
</div>

