@extends('front.base')

@section('content')

    <div class="pure-g">
        <div class="pure-u-1">
            <h1>Reset Password</h1>
            <form class="pure-form pure-form-aligned" method="POST" action="/password/email">
                <fieldset>
                    {!! csrf_field() !!}

                    @if (count($errors) > 0)
                        <ul class="errors">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if (isset($status))
                        {{ $status }}
                    @endif

                    <div class="pure-control-group">
                        <label for="email">Email</label>
                        <input class="c-input" type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="pure-controls">
                        <button class="pure-button pure-button-primary" type="submit">Send Password Reset Link</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection