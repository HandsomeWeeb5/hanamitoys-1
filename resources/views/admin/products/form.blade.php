@extends('admin.master')

@section('title', 'Tambah Produk')

@php
$formTitle = !empty($category) ? 'Ubah' : 'Tambah'
@endphp

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ $formTitle }} Produk</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
          <li class="breadcrumb-item active">{{ $formTitle }}</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="float-sm-right">
          <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="row">
    <div class="col-lg-4">
      @include('admin.products.product_menus')
    </div>
    <div class="col-lg-8">
      <div class="card card-default">
        <div class="card-body">
          @include('admin.components.flash', ['$errors' => $errors])
          @if (!empty($product))
          {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'PUT']) !!}
          {!! Form::hidden('id') !!}
          @else
          {!! Form::open(['route' => 'products.store']) !!}
          @endif
          <div class="form-group">
            {!! Form::label('sku', 'SKU') !!}
            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'Masukan SKU']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('name', 'Nama') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('price', 'Harga') !!}
            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Masukan Harga']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('category_ids', 'Category') !!}
            {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'id' => 'category_ids', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Pilih Kategori --']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('short_description', 'Deskripsi Pendek') !!}
            {!! Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' => 'Masukan Deskripsi Pendek']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('description', 'Deskripsi') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Masukan Deskripsi']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Pilih Status --']) !!}
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