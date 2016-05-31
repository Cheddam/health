@extends('front.base')

@section('content')
    <h1>Profile</h1>

    <form method="POST">
        {{ csrf_field() }}


        <h3>Basic Information</h3>
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" required value="{{ $user->name }}">
        </p>

        <p>
            <label for="email">Email</label>
            <input type="email" name="email" required value="{{ $user->email }}">
        </p>

        <p><br></p>

        <h3>Subscriptions</h3>
        @foreach($notifications as $not)

            <p>
                <input type="checkbox" name="sub[{{ $not->id }}]" {{ $user->hasSubscription($not->id) ? 'checked' : '' }}>
                <label for="sub[{{ $not->id }}]">{{ $not->name }}</label>
            </p>

        @endforeach

        <button type="submit" class="pure-button pure-button-primary">Save Changes</button>
    </form>
@endsection