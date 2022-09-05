@extends('layouts.guest')

@section('content')

    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="/"><img class="logo-img" src="{{ asset('images/logo-camrail.png') }}" style="height: 70px" alt="logo"></a><span class="splash-description">Veillez vous connecter.</span></div>
            <div class="card-body">
                @include('_partial._flash-message')
                <form method="POST" action="{{ route('login') }}">
                    <div class="form-group">
                        @csrf
{{--                        <label><strong>Email</strong></label>--}}
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
{{--                        <label><strong>Mot de passe</strong></label>--}}
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}><span class="custom-control-label">Remember Me</span>
                            </label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger btn-block">Se connecter</button>
                    </div>
                    <div class="card-footer bg-white p-0  ">
                        <div class="card-footer-item card-footer-item-bordered">
                        </div>
                        <div class="card-footer-item card-footer-item-bordered">
                            @if (Route::has('password.request'))
                                <a class="footer-link" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>


@endsection
