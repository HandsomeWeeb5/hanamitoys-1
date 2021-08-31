@extends('admin.master')

@section('title', 'Tambah Atribut')

@php
$formTitle = !empty($attribute) ? 'Ubah' : 'Tambah';
$disableInput = !empty($attribute) ? true : false;
@endphp

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ $formTitle }} Atribut</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('attributes.index') }}">Atribut</a></li>
          <li class="breadcrumb-item active">{{ $formTitle }}</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="float-sm-right">
          <a href="{{ route('attributes.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-default">
        <div class="card-body">
          @include('admin.components.flash', ['$errors' => $errors])
          @if (!empty($attribute))
          {!! Form::model($attribute, ['route' => ['attributes.update', $attribute->id], 'method' => 'PUT']) !!}
          {!! Form::hidden('id') !!}
          @else
          {!! Form::open(['route' => 'attributes.store']) !!}
          @endif
          <fieldset class="form-group">
            <div class="row">
              <div class="col-lg-12">
                <legend class="col-form-label pt-0">Umum</legend>
                <hr>
                <div class="form-group">
                  {!! Form::label('code', 'Kode') !!}
                  {!! Form::text('code', null, ['class' => 'form-control', 'readonly' => $disableInput]) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('name', 'Nama') !!}
                  {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('type', 'Tipe') !!}
                  {!! Form::select('type', $types , null, ['class' => 'form-control', 'placeholder' => '-- Pilih Tipe --', 'readonly' => $disableInput]) !!}
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <div class="row">
              <div class="col-lg-12">
                <legend class="col-form-label pt-0">Validasi</legend>
                <hr>
                <div class="form-group">
                  {!! Form::label('is_required', 'Apa Diperlukan?') !!}
                  {!! Form::select('is_required', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('is_unique', 'Apa Unik?') !!}
                  {!! Form::select('is_unique', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('validation', 'Validasi') !!}
                  {!! Form::select('validation', $validations , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <div class="row">
              <div class="col-lg-12">
                <legend class="col-form-label pt-0">Konfigurasi</legend>
                <hr>
                <div class="form-group">
                  {!! Form::label('is_configurable', 'Apa digunakan dalam Produk yang Dapat Dikonfigurasi?') !!}
                  {!! Form::select('is_configurable', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('is_filterable', 'Apa digunakan dalam Memfilter Produk?') !!}
                  {!! Form::select('is_filterable', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
              </div>
            </div>
          </fieldset>
          <div class="form-footer text-center pt-3 border-top">
            <button type="submit" class="btn btn-primary">{{ $formTitle }}</button>
            <button type="reset" class="btn btn-danger">Reset</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection