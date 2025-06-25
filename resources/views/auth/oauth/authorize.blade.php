<!DOCTYPE html>
<html>
<head>
    <title>Authorize Application</title>
</head>
<body>
<h2>Authorize "{{ $client->name }}" to access your account?</h2>

@if (count($scopes) > 0)
    <p>This application will be able to:</p>
    <ul>
        @foreach ($scopes as $scope)
            <li><strong>{{ $scope->description }}</strong></li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('passport.authorizations.approve') }}">
    @csrf
    <input type="hidden" name="state" value="{{ request('state') }}">
    <input type="hidden" name="client_id" value="{{ request('client_id') }}">
    <input type="hidden" name="auth_token" value="{{ $authToken }}">

    <button type="submit">Authorize</button>
</form>

<form method="POST" action="{{ route('passport.authorizations.deny') }}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="state" value="{{ request('state') }}">
    <input type="hidden" name="client_id" value="{{ request('client_id') }}">
    <input type="hidden" name="auth_token" value="{{ $authToken }}">

    <button type="submit">Cancel</button>
</form>

</body>
</html>
