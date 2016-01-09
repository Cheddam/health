	<div class="top-nav-wrapper nav-wrapper back-nav-wrapper">
		<nav class="pure-menu pure-menu-horizontal nav" role="navigation">
			<a class="pure-menu-heading pure-menu-link nav-link nav-brand" href="/">HealthClub Admin</a>
			<ul class="pure-menu-list nav-items pull-right">
				<li class="pure-menu-item nav-item"><a class="pure-menu-link nav-link {{ Request::is('back/goals') ? 'active' : '' }}" href="/back/goals">Goals</a></li>
				<li class="pure-menu-item nav-item"><a class="pure-menu-link nav-link nav-link-disabled {{ Request::is('back/challenges') ? 'active' : '' }}" href="/back/challenges">challenges</a></li>
				<li class="pure-menu-item nav-item"><a class="pure-menu-link nav-link" href="/auth/logout">Sign Out</a></li>
			</ul>
		</nav>
	</div>