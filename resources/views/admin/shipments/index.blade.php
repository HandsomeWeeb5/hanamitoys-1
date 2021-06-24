@extends('admin.master')

@section('title', 'Pengiriman')

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
        <h1 class="m-0">Pengiriman</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item active">Pengiriman</li>
        </ol>
      </div>
    </div>
  </div>
</div>

{{-- Main Content --}}
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Tabel Order</h3>
      </div>
      <div class="card-body">
        @include('admin.components.flash')
        <table id="dataTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Name</th>
              <th>Status</th>
              <th>Total Qty</th>
              <th>Total Weight (gram)</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($shipments as $shipment)
            <tr>
              <td>
                {{ $shipment->order->code }}<br>
                <span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($shipment->order->order_date) }}</span>
              </td>
              <td>{{ $shipment->order->customer_full_name }}</td>
              <td>
                {{ $shipment->status }}
                <br>
                <span style="font-size: 12px; font-weight: normal"> {{ $shipment->shipped_at }}</span>
              </td>
              <td>{{ $shipment->total_qty }}</td>
              <td>{{ \General::priceFormat($shipment->total_weight) }}</td>
              <td>
                <a href="{{ url('admin/orders/'. $shipment->order->id) }}" class="btn btn-info btn-sm">show</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5">No records found</td>
            </tr>
            @endforelse
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