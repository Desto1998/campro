@extends('layouts.guest')

@section('content')
    <div class="splash-container">
        <div class="card ">
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
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Envoyer le lien') }}
                        </button>
                        <a class="btn btn-link" href="{{ route('login') }}">
                            {{ __('Revenir') }}
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>



@endsection
