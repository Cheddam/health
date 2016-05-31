	<div class="nav-wrapper front-nav-wrapper">
		<nav class="pure-menu pure-menu-horizontal nav" role="navigation">
			<a class="pure-menu-heading pure-menu-link nav-link nav-brand" href="/">HealthClub</a>
			<ul class="pure-menu-list front-menu-items pull-right">
				@if (Auth::check() && Auth::user()->hasRole('admin'))
					<li class="pure-menu-item nav-item"><a class="pure-menu-link nav-link" href="/back">Administration</a></li>
				@endif
				<li class="pure-menu-item nav-item"><a class="pure-menu-link nav-link {{ Request::is('leaderboards') ? 'active' : '' }}" href="/leaderboards">Leaderboards</a></li>
				@if(Auth::check())
				<li class="pure-menu-item nav-item">
					<a class="pure-menu-link nav-link {{ Request::is('fill') ? 'active' : '' }}" href="/fill">Fill</a>
				</li>
				<li class="pure-menu-item nav-item">
					<a class="pure-menu-link nav-link {{ Request::is('profile') ? 'active' : '' }}" href="/profile">Profile</a>
				</li>
				@else
				<li class="pure-menu-item nav-item">
					<a class="pure-menu-link nav-link {{ Request::is('auth/register') ? 'active' : '' }}" href="/auth/register">Register</a>
				</li>
				@endif
			</ul>
		</nav>
	</div>