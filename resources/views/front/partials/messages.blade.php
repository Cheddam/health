@if (Session::has('notice'))
    <span class="alert alert-notice">{{ Session::get('notice') }}</span>
@endif

@if (Session::has('success'))
    <span class="alert alert-success">{{ Session::get('success') }}</span>
@endif

@if (Session::has('warning'))
    <span class="alert alert-warning">{{ Session::get('warning') }}</span>
@endif

@if (Session::has('error'))
    <span class="alert alert-error">{{ Session::get('error') }}</span>
@endif

@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <span class="alert alert-error">{{ $error }}</span>
    @endforeach
@endif