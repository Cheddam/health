@extends('emails.base')

@section('content')

    <h2>Remember your goals!</h2>

    <p>Good morning {{ $user->name }},</p>

    <p>Hope your morning is going swimmingly! Remember to <a href="https://sshc.nz/fill">tick off your Junk Free June goal</a> if you hit it today.</p>

@endsection