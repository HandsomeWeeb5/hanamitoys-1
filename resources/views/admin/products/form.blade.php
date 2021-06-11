@extends('admin.master')

@section('title', 'Tambah Produk')

@php
$formTitle = !empty($product) ? 'Ubah' : 'Tambah'
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
    <div class="col-lg-3">
      @include('admin.products.product_menus')
    </div>
    <div class="col-lg-9">
      <div class="card card-default">
        <div class="card-body">
          @include('admin.components.flash', ['$errors' => $errors])
          @if (!empty($product))
          {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
          {!! Form::hidden('id') !!}
          {!! Form::hidden('type') !!}
          @else
          {!! Form::open(['url' => 'admin/products']) !!}
          @endif
          <div class="form-group">
            {!! Form::label('type', 'Type') !!}
            {!! Form::select('type', $types , !empty($product) ? $product->type : null, ['class' => 'form-control product-type', 'placeholder' => '-- Choose Product Type --', 'disabled' => !empty($product)]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('sku', 'SKU') !!}
            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'sku']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('category_ids', 'Category') !!}
            {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
          </div>
          <div class="configurable-attributes">
            @if (!empty($configurableAttributes) && empty($product))
            <p class="text-primary mt-4">Configurable Attributes</p>
            <hr />
            @foreach ($configurableAttributes as $attribute)
            <div class="form-group">
              {!! Form::label($attribute->code, $attribute->name) !!}
              {!! Form::select($attribute->code. '[]', $attribute->attributeOptions->pluck('name','id'), null, ['class' => 'form-control', 'multiple' => true]) !!}
            </div>
            @endforeach
            @endif
          </div>

          @if ($product)
          @if ($product->type == 'configurable')
          @include('admin.products.configurable')
          @else
          @include('admin.products.simple')
          @endif

          <div class="form-group">
            {!! Form::label('short_description', 'Short Description') !!}
            {!! Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' => 'short description']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Set Status --']) !!}
          </div>
          @endif
          <div class="form-footer pt-5 border-top">
            <button type="submit" class="btn btn-primary btn-default">Save</button>
            <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Back</a>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function showHideConfigurableAttributes() {
    var productType = $(".product-type").val();

    if (productType == 'configurable') {
      $(".configurable-attributes").show();
    } else {
      $(".configurable-attributes").hide();
    }
  }
  $(function() {
    showHideConfigurableAttributes();
    $(".product-type").change(function() {
      showHideConfigurableAttributes();
    });
  });
</script>
@endsection