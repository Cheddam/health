@extends('front.base')

@section('content')

	<div class="pure-g">
		<div class="pure-u-1">
			<h1>Log In</h1>
			<form class="pure-form pure-form-aligned" method="POST" action="/auth/login">
				<fieldset>
					{!! csrf_field() !!}

					{{-- TODO: Remove once proper alerts are styled up --}}
					@if (count($errors) > 0)
						<ul class="errors">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					@endif
					
					<div class="pure-control-group">
						<label for="email">Email</label>
						<input class="c-input" type="email" name="email" value="{{ old('email') }}">
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
						<a class="pure-button" href="/password/email">Forgot your password?</a>
					</div>

				</fieldset>
			</form>
		</div>
	</div>
	
@endsection