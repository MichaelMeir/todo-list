<!DOCTYPE html>
<html>
<head>
    <title>Todo list</title>
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/app.css')) }}">
    <meta name="csrf-token" value="{{ csrf_token() }}">
</head>
<body class="font-sans bg-grey middle">
    <div id="app" class="container max-w-sm mx-auto bg-beige mt-4 rounded-sm p-3 text-black border-2 border-brown text-left">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label>Name:</label>

                <input id="name" type="text" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group row">
                <label>E-mail Address:</label>

                <input id="email" type="email" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

            </div>

            <div>
                <label for="password">Password:</label>

                <input id="password" type="password" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" name="password" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div>
                <label for="password-confirm">Confirm Password:</label>

                <input id="password-confirm" type="password" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" name="password_confirmation" required>
            </div>

            <div>
                <button type="submit" class="border-2 border-black mt-1 rounded-sm p-1">
                    Register
                </button>
                <a href="/login" class="no-underline text-black border-2 border-black mt-1 rounded-sm p-1">
                    Login
                </a>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
