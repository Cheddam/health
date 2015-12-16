@extends('front.base')

@section('content')

	<div class="pure-g">
		<div class="pure-u-1">
			<h1>Log In</h1>
			<form class="pure-form pure-form-aligned" method="POST" action="/auth/login">
				<fieldset>
					{!! csrf_field() !!}
					
					<div class="pure-control-group">
						<label for="email">Email</label>
						<input class="c-input" type="text" name="email" value="{{ old('name') }}">
					</div>

					<div class="pure-control-group">
						<label for="password">Password</label>
						<input class="c-input" type="password" name="password">
					</div>

					<div class="pure-control-group">
						<label for="remember">Remember Me</label>
						<input class="c-input" type="checkbox" name="remember">
					</div>

					<div class="pure-controls">
						<button class="pure-button pure-button-primary" type="submit">Log In</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	
@endsection