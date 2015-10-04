<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    </div> 
        Gender
        <input type="radio" name="gender" value="male" checked> Male
        <input type="radio" name="gender" value="female" checked> Female
    </div>

    <div>
        Weight (lbs)
        <input type="weight" name="weight">
    </div>

    <div>
        Height
        <input type="height" name="height">
    </div>

    <div>
        Dietary Restrictions
        <input type="checkbox" name="restriction1" value="nuts"> No nuts
        <input type="checkbox" name="restriction2" value="seafood"> No seafood
        <input type="checkbox" name="restriction3" value="dairy"> No dairy 
        <input type="checkbox" name="restriction4" value="chocolate"> No chocolate
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>