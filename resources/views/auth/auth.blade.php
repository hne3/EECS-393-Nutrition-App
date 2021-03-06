<!-- resources/views/auth/login.blade.php -->

<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember" /><label for="checkbox">Remember Me</label>
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
