@extends('front.base')

@section('content')
    <div class="pure-g">
        <div class="pure-u">
            <h1>Welcome to HealthClub</h1>
            <p>An uber sweet service for u and ur fit fransssss</p>
            @if(Auth::guest())
                <p><a href="/auth/register">Register</a></p>
            @endif
        </div>
    </div>
@endsection