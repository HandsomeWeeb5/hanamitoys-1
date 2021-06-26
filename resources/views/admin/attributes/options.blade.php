@extends('admin.master')

@section('title', 'Tambah Atribut')

@php
$formTitle = !empty($attributeOption) ? 'Ubah' : 'Tambah';
@endphp

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ $formTitle }} Opsi Atribut</h1>
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
    <div class="col-lg-5">
      @include('admin.attributes.option_form')
    </div>
    <div class="col-lg-7">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">Opsi Untuk: {{ $attribute->name }}</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <th style="width:10%">No</th>
              <th>Name</th>
              <th style="width:30%">Action</th>
            </thead>
            <tbody>
              @foreach ($attribute->attributeOptions as $index => $option)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $option->name }}</td>
                <td>
                  <a href="{{ url('admin/attributes/options/'. $option->id .'/edit') }}" class="btn btn-warning btn-sm">Ubah</a>
                  {!! Form::open(['url' => 'admin/attributes/options/'. $option->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                  {!! Form::hidden('_method', 'DELETE') !!}
                  {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                  {!! Form::close() !!}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection