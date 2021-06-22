@extends('customer.master')

@section('title', ' | Registrasi')

@section('content')
<div class="container content-container-register">
  <div class="register-box mx-4 text-center text-md-left">
    <h2 class="mb-4">REGISTER AKUN</h2>
    {!! Form::open(['route' => 'register']) !!}
    <div class="form-row">
      <div class="col-md-6 mb-3">
        {!! Form::label('first_name', 'Nama Depan') !!}
        <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

        @error('first_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-md-6 mb-3">
        {!! Form::label('last_name', 'Nama Belakang') !!}
        <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

        @error('last_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('email', 'Email Address') !!}
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="form-row">
      <div class="col-md-6 mb-3">
        {!! Form::label('password', 'Kata Sandi') !!}
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6 mb-3">
        {!! Form::label('password-confirm', 'Konfirmasi Kata Sandi') !!}
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
      </div>
    </div>
    <div class="form-group col-md-12 px-md-2 text-center">
      <button class="btn btn-primary" type="submit">Register</button>
      <p class="mt-2">Sudah mempunyai akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection