	<div class="nav-wrapper front-nav-wrapper">
		<nav class="pure-menu pure-menu-horizontal nav" role="navigation">
			<a class="pure-menu-heading pure-menu-link nav-link nav-brand" href="/">HealthClub</a>
			<ul class="pure-menu-list front-menu-items pull-right">
				<li class="pure-menu-item nav-item"><a class="pure-menu-link nav-link {{ Request::is('leaderboards') ? 'active' : '' }}" href="/leaderboards">Leaderboards</a></li>
				<li class="pure-menu-item nav-item">
					@if(Auth::check())
						<a class="pure-menu-link nav-link {{ Request::is('fill') ? 'active' : '' }}" href="/fill">Fill</a>
					@else
						<a class="pure-menu-link nav-link {{ Request::is('auth/register') ? 'active' : '' }}" href="/auth/register">Register</a>
					@endif
				</li>
			</ul>
		</nav>
	</div>