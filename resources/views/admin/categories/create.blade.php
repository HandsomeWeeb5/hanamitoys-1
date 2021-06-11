@extends('admin.master')

@section('title', 'Tambah Kategori')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
          <li class="breadcrumb-item active">Tambah</li>
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
          @if ($errors->any())
          <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Whoops!</h5>
            There are some problems with your input.<br /><br />
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Nama Kategori</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama Kategori">
            </div>
            <div class="form-group">
              <label for="parent_id">Induk</label>
              {!! General::selectMultiLevel('parent_id', $categories, ['class' => 'form-control', 'id' => 'parent_id', 'selected' => (!empty(old('parent_id')) ? old('parent_id') : !empty($category['parent_id'])) ? $category['parent_id'] : '', 'placeholder' => '-- Pilih Kategori --']) !!}
            </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top text-center">
              <button name="submit" type="submit" class="btn btn-primary mr-2">Tambah</button>
              <button type="reset" class="btn btn-danger">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection