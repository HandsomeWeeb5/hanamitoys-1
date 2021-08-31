@extends('admin.master')

@section('title', 'Orders')

@section('content')
{{-- Content Header (Page Hedaer) --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tampilkan Order</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Order</a></li>
          <li class="breadcrumb-item active">{{ $order->code }}</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="float-sm-right">
          <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
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
          <!-- Admin Invoice -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> Hanami Toys.
                  <small class="float-right">Tanggal: {{ \General::dateFormat($order->order_date) }}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                <address>
                  <strong>Alamat Tagihan</strong><br>
                  {{ $order->customer_first_name }} {{ $order->customer_last_name }}<br>
                  {{ $order->customer_address1 }}<br>
                  {{ $order->customer_address2 }}<br>
                  Email: {{ $order->customer_email }}<br>
                  Phone: {{ $order->customer_phone }}<br>
                  Postcode: {{ $order->customer_postcode }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <address>
                  <strong>Alamat Pengiriman</strong><br>
                  {{ $order->customer_first_name }} {{ $order->customer_last_name }}<br>
                  {{ $order->customer_address1 }}<br>
                  {{ $order->customer_address2 }}<br>
                  Email: {{ $order->customer_email }}<br>
                  Phone: {{ $order->customer_phone }}<br>
                  Postcode: {{ $order->customer_postcode }}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <strong>Detail</strong><br>
                <strong>Invoice ID:</strong> {{ $order->code }}<br>
                <strong>Tanggal:</strong> {{ \General::datetimeFormat($order->order_date) }}<br>
                <strong>Shipped by: </strong> {{ $order->shipping_service_name }}
                <address>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Item</th>
                      <th>Deskripsi</th>
                      <th>Kuantitas</th>
                      <th>Harga Perbarang</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      @forelse ($order->orderItems as $item)
                    <tr>
                      <td>{{ $item->sku }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{!! General::showAttributes($item->attributes) ?? 'k' !!}</td>
                      <td>{{ $item->qty }}</td>
                      <td>@currency($item->base_price)</td>
                      <td>@currency($item->sub_total)</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="6">Data Order Tidak Ditemukan!</td>
                    </tr>
                    @endforelse
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- /.col -->
              <div class="col-6 ml-auto">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>@currency($order->base_total_price)</td>
                      </tr>
                      <tr>
                        <th>Ongkos Kirim:</th>
                        <td>@currency($order->shipping_cost)</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>@currency($order->grand_total)</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                @if (!$order->trashed())
                @if ($order->isPaid() && $order->isConfirmed())
                <a href="{{ url('admin/shipments/'. $order->shipment->id .'/edit')}}" class="btn mt-2 ml-1 float-right btn-lg btn-primary btn-pill"> Proses Ke Pengiriman</a>
                @endif

                @if (in_array($order->status, [\App\Models\Order::CREATED, \App\Models\Order::CONFIRMED]))
                <a href="{{ url('admin/orders/'. $order->id .'/cancel')}}" class="btn mt-2 ml-1 float-right btn-lg btn-warning btn-pill"> Batal</a>
                @endif

                @if ($order->isDelivered())
                <a href="#" class="btn mt-2 ml-1 float-right btn-lg btn-success btn-pill" onclick="event.preventDefault();
						document.getElementById('complete-form-{{ $order->id }}').submit();"> Tandai Sebagai Selesai</a>

                {!! Form::open(['url' => 'admin/orders/complete/'. $order->id, 'id' => 'complete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::close() !!}
                @endif

                @if (!in_array($order->status, [\App\Models\Order::DELIVERED, \App\Models\Order::COMPLETED]))
                <a href="#" class="btn mt-2 ml-1 float-right btn-lg btn-danger btn-pill delete" order-id="{{ $order->id }}"> Hapus</a>

                {!! Form::open(['url' => 'admin/orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
                @endif
                @else
                <a href="{{ url('admin/orders/restore/'. $order->id)}}" class="btn mt-2 ml-1 float-right btn-lg btn-outline-secondary btn-pill restore"> Kembalikan</a>
                <a href="#" class="btn mt-2 ml-1 float-right btn-lg btn-danger btn-pill delete" order-id="{{ $order->id }}"> Hapus Permanen</a>

                {!! Form::open(['url' => 'admin/orders/'. $order->id, 'class' => 'delete', 'id' => 'delete-form-'. $order->id, 'style' => 'display:none']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::close() !!}
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $("a.delete").on("click", function() {
    event.preventDefault();
    var orderId = $(this).attr('order-id');
    if (confirm("Do you want to remove this?")) {
      document.getElementById('delete-form-' + orderId).submit();
    }
  });

  $(".restore").on("click", function() {
    return confirm("Do you want to restore this?");
  });
</script>
@endsection