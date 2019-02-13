<!DOCTYPE html>
<html>
<head>
    <title>Todo list</title>
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/app.css')) }}">
    <meta name="csrf-token" value="{{ csrf_token() }}">
</head>
<body class="font-sans bg-grey middle">
    <div id="app" class="container max-w-sm mx-auto bg-beige mt-4 rounded-sm p-3 text-black border-2 border-brown text-center">
        <form action="{{ route('login') }}" method="post" class="text-left">
            @csrf
            <div>
                <label>E-mail Address:</label>
                <input id="email" type="email" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div>
                <label>Password:</label>
                <input id="password" type="password" class="bg-beige border-b-2 border-black outline-none mt-2 ml-1 h-5 w-full" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div>
                <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="" for="remember">
                    Remember me
                </label>
            </div>
            <div>
                <button type="submit" class="border-2 border-black mt-1 rounded-sm p-1">
                   Login
                </button>
                <a href="/register" class="no-underline text-black border-2 border-black mt-1 rounded-sm p-1">
                    Register
                </a>
                @if (Route::has('password.request'))
                    <a class="p-1" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>