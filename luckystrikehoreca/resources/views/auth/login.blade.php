<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body class="backgroundImage">
    <x-customer-header></x-customer-header>
    <div class="filter">
        <div id="app">
            <main class="py-4">
                    <div class="containerHelp">
                        <div class="row justify-content-start loginHolder">
                            <div class="col-md-8 offset-md-2 mediaScale">
                                <h1 class="mb-4">Lucky Strike</h1>

                                <form method="POST" action="{{ route('login') }}">
                                @csrf
                            
                                <div class="row mb-3 mediaContainerScale">
                                    <div class="inputGroup inputGroupIcon inputLogin">
                                        <input type="email" placeholder="Email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <div class="inputIcon">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="inputGroup inputGroupIcon inputLogin">
                                        <input type="password" name="password" placeholder="Wachtwoord"  class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                                        <div class="inputIcon">
                                            <i class="fa-solid fa-lock"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="mediaContainerScale">
                                        @if (Route::has('password.request'))
                                    <a class="btn btn-link forgotPasswordLink" href="{{ route('password.request') }}">
                                        {{ __('Wachtwoord vergeten?') }}
                                    </a>
                                    @endif
                                
                                    </div>
                                    <div class="col mb-0 mediaContainerScale">
                                        <div class="row-md-8 f-start">
                                            <button type="submit" class="lightButton">
                                                {{ __('Inloggen') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                <div class="yellowBlock d-flex flex-row">
                    <h2>Horeca</h2>
                    <p>Veel plezier</p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
