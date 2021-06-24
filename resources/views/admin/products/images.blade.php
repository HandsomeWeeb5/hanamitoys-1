@extends('admin.master')

@section('title', 'Produk')

@section('content')

@php
$formTitle = !empty($category) ? 'Ubah' : 'Tambah'
@endphp

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
        <div class="card-header card-header-border-bottom">
          <h2>Product Images</h2>
        </div>
        <div class="card-body">
          @include('admin.components.flash')
          <table class="table table-bordered table-stripped">
            <thead>
              <th>#</th>
              <th>Image</th>
              <th>Uploaded At</th>
              <th>Action</th>
            </thead>
            <tbody>
              @forelse ($productImages as $image)
              <tr>
                <td>{{ $image->id }}</td>
                <td><img src="{{ asset('storage/'.$image->small) }}" style="width:150px"></td>
                <td>{{ $image->created_at }}</td>
                <td>
                  {!! Form::open(['url' => 'admin/products/images/'. $image->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                  {!! Form::close() !!}
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4">No records found</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer text-right">
          <a href="{{ url('admin/products/'.$productID.'/add-image') }}" class="btn btn-primary">Add New</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection