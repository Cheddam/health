	<nav class="pure-menu pure-menu-horizontal" role="navigation">
		<a class="pure-menu-heading pure-menu-link" href="/">Health</a>
		<ul class="pure-menu-list">
			<li class="pure-menu-item"><a class="pure-menu-link" href="/leaderboard">Leaderboard</a></li>
			<li class="pure-menu-item main-action">
				@if(Auth::check())
					<a class="pure-menu-link" href="/log">Log</a>
				@else
					<a class="pure-menu-link" href="/auth/register">Commit</a>
				@endif
			</li>
		</ul>
	</nav>