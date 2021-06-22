@extends('customer.master')

@section('title', ' | Login')

@section('content')
<div class="container content-container-login px-4 m-auto">
  <div class="login-box text-center">
    <h2>LOGIN AKUN</h2>
    {!! Form::open(['route' => 'login']) !!}
    <div class="form-group">
      {!! Form::label('email', 'Email') !!}
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="form-group">
      {!! Form::label('password', 'Password') !!}
      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" required autocomplete="current-password">

      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    @if (Route::has('password.request'))
    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
          {{ __('Remember Me') }}
        </label>
      </div>
    </div>
    <p class="lupa-password">
      Lupa Password? <a href="{{ route('password.request') }}">Klik disini</a>
    </p>
    @endif
    <button class="btn login-btn" type="submit">LOGIN</button>
    <a class="btn register-btn" href="{{ route('register') }}">REGISTER</a>
    {!! Form::close() !!}
  </div>
</div>
@endsection