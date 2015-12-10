	<nav class="pure-menu pure-menu-horizontal" role="navigation">
		<a class="pure-menu-heading pure-menu-link" href="/">Health</a>
		<ul class="pure-menu-list">
			<li class="pure-menu-item"><a class="pure-menu-link" href="/back/goals">Edit Goals</a></li>
			@if(Auth::check())
			<li class="pure-menu-item">
				<a class="pure-menu-link" href="/auth/logout">Sign Out</a>
			</li>
			@endif
		</ul>
	</nav>