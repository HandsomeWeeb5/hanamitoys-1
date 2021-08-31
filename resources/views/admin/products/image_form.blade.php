@extends('admin.master')

@section('title', 'Produk')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Gambar</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
          <li class="breadcrumb-item active">Tambah Gambar</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="float-sm-right">
          <a href="{{ url('admin/products/'.$productID.'/images') }}" class="btn btn-secondary">Kembali</a>
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
        <div class="card-header card-header-border-bottom">
          <h2>Upload Gambar</h2>
        </div>
        <div class="card-body">
          @include('admin.components.flash', ['$errors' => $errors])
          {!! Form::open(['url' => ['admin/products/images', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
          <div class="form-group">
            {!! Form::label('image', 'Gambar Produk') !!}
            {!! Form::file('image', ['class' => 'form-control-file', 'placeholder' => 'product image']) !!}
          </div>
          <div class="form-footer pt-5 border-top">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('admin/products/'.$productID.'/images') }}" class="btn btn-secondary">Kembali</a>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection