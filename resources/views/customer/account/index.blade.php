@extends('customer.master')

@section('title', '| Account')

@section('content')
<div class="container content-account px-4">
  <form method="POST">
    <div class="row">
      <div class="account-identity-box col-md-5 d-flex align-items-center flex-column justify-content-center">
        <img class="img-fluid mb-2" src="img/brick.PNG" alt="photo_profile">
        <div class="account-name">{{ auth()->user()->name }}</div>
        <small class="role mb-3">Pembeli</small>
        <div class="form-group">
          <button class="btn btn-custom">Change Photo</button>
          <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">Logout</button>
        </div>
      </div>
      <div class="profile-form col-md-7 mt-4 mt-md-0 text-center">
        <div class="form-group">
          <label for="name">Nama Pengguna</label>
          <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control" name="alamat" rows="4" id="alamat"></textarea>
        </div>
        <div class="form-group">
          <label for="noTelp">Nomor Telepon</label>
          <input type="text" class="form-control" name="noTelp" id="noTelp">
        </div>
        <div class="form-group">
          <label for="email">Email Pengguna</label>
          <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
          <label for="current-password">Password Saat Ini</label>
          <input type="password" class="form-control" name="current-password" id="current-password">
        </div>
        <div class="form-group">
          <label for="new-password">Password Baru</label>
          <input type="password" class="form-control" name="new-password" id="new-password">
        </div>
        <div class="form-group">
          <label for="new-password-confirmation">Konfirmasi Password Baru</label>
          <input type="password" class="form-control" name="new-password-confirmation" id="new-password-confirmation">
        </div>
        <button class="btn btn-custom" type="submit">Simpan Perubahan</button>
      </div>
    </div>
  </form>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
</div>
@endsection