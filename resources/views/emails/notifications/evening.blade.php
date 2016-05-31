@extends('emails.base')

@section('content')

    <h2>Did you complete your goals today?</h2>

    <p>Howdy {{ $user->name }},</p>

    <p>If you nailed your Junk Free June goal today, remember to <a href="https://sshc.nz/fill">tick it off</a>.</p>

    <p>Enjoy the rest of your evening!</p>

@endsection