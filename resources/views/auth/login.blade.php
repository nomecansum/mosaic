@extends('layout')

@section('content')
<div class="cls-content">
    <div class="cls-content-sm panel">
        <div class="panel-body">
            <div class="mar-ver pad-btm">
                <img src="{{url('/img/Mosaic_brand_300.png')}}" style="width:300px">
                <p>Sign In to your account</p>
            </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="checkbox pad-btm text-left">
                                    <input class="form-check-input magic-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label for="demo-form-checkbox">
                                        {{ __('Remember Me') }}
                                    </label>
                        </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Login') }}
                                </button>
                    </form>
                </div>
                        <div class="pad-all">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <a href="{{ url('/register') }}" class="btn-link mar-lft">Create a new account</a>
                        </div>
    </div>

</div>
@endsection
