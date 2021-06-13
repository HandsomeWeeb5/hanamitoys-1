@extends('admin.master')

@section('title', 'Tambah Kategori')

@php
$formTitle = !empty($category) ? 'Ubah' : 'Tambah'
@endphp

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ $formTitle }} Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
          <li class="breadcrumb-item active">{{ $formTitle }}</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="float-sm-right">
          <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
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
          @if (!empty($category))
          {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}
          {!! Form::hidden('id') !!}
          @else
          {!! Form::open(['route' => 'categories.store']) !!}
          @endif
          <div class="form-group">
            {!! Form::label('name', 'Nama') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('parent_id', 'Induk') !!}
            {!! General::selectMultiLevel('parent_id', $categories, ['class' => 'form-control', 'id' => 'parent_id', 'selected' => !empty(old('parent_id')) ? old('parent_id') : (!empty($category['parent_id']) ? $category['parent_id'] : ''), 'placeholder' => '-- Pilih Kategori --']) !!}
          </div>
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