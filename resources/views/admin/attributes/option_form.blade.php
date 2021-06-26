@php
$title = !empty($attributeOption) ? 'Ubah' : 'Tambah';
@endphp

<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>{{ $title }} Opsi</h2>
  </div>
  <div class="card-body">
    @include('admin.components.flash', ['$errors' => $errors])
    @if (!empty($attributeOption))
    {!! Form::model($attributeOption, ['url' => ['admin/attributes/options', $attributeOption->id], 'method' => 'PUT']) !!}
    {!! Form::hidden('id') !!}
    @else
    {!! Form::open(['url' => ['admin/attributes/options', $attribute->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    @endif
    {!! Form::hidden('attribute_id', $attribute->id) !!}
    <div class="form-group">
      {!! Form::label('name', 'Nama') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-footer pt-5 border-top">
      <button type="submit" class="btn btn-primary">{{ $title }}</button>
      <a href="{{ url('admin/attributes/'.$attribute->id.'/options') }}" class="btn btn-secondary">Kembali</a>
    </div>
    {!! Form::close() !!}
  </div>
</div>