@extends('admin.master')

@section('title', 'Produk')

@section('css')
{{-- DataTable --}}
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
{{-- Content Header (Page Hedaer) --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Produk</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item active">Produk</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="float-sm-right">
          <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Produk</a>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Main Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Tabel Produk</h3>
      </div>
      <div class="card-body">
        @include('admin.components.flash')
        <table id="dataTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>SKU</th>
              <th>Tipe</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Status</th>
              <th style="width: 15%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $index => $product)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $product->sku }}</td>
              <td>{{ $product->type }}</td>
              <td>{{ $product->name }}</td>
              <td>@currency($product->price)</td>
              <td>{{ $product->statusLabel() }}</td>
              <td>
                <a href="{{ url('admin/products/'. $product->id .'/edit') }}" class="btn btn-info btn-sm">Ubah</a>

                {!! Form::open(['url' => 'admin/products/'. $product->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
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
</section>
@endsection

@section('scripts')
{{-- DataTable --}}
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function() {
    $("#dataTable").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection