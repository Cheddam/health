@extends('front.base')

@section('content')

	<div class="pure-g">
		<div class="pure-u-1">
			<h1>Register</h1>
			<form class="pure-form pure-form-aligned" method="POST" action="/auth/register">
				<fieldset>
					{!! csrf_field() !!}

					@if (count($errors) > 0)
						<ul class="errors">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					@endif

					<div class="pure-control-group">
						<label for="name">Name</label>
						<input class="c-input" type="text" name="name" value="{{ old('name') }}">
					</div>

					<div class="pure-control-group">
						<label for="email">Email</label>
						<input class="c-input" type="email" name="email" value="{{ old('email') }}">
					</div>

					<div class="pure-control-group">
						<label for="password">Password</label>
						<input class="c-input" type="password" name="password">
					</div>

					<div class="pure-control-group">
						<label for="password_confirmation">Confirm Password</label>
						<input class="c-input" type="password" name="password_confirmation">
					</div>

					<div class="pure-controls">
						<button class="pure-button pure-button-primary" type="submit">Register</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

@endsection