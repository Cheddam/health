@extends('front.base')

@section('content')
    <div class="pure-g">
        <div class="pure-u home-content">
            <h1>Welcome to HealthClub</h1>
            <p>Complete goals, earn points, improve yourself!</p>
            @if(Auth::guest())
                <p>
                	<a class="pure-button" href="/auth/login">Log In</a>
                	<a class="pure-button pure-button-primary" href="/auth/register">Register</a>
                </p>
            @endif
        </div>
    </div>
@endsection