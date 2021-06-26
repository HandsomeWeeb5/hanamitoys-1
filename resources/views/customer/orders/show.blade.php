@extends('customer.master')

@section('title', ' | Order Detail')

@section('content')
<div class="container" style="background: white; min-height: 100vh">
  <!-- Admin Invoice -->
  <div class="invoice p-3 mb-3">
    <div class="row">
      <div class="col-12 mb-5 mt-4 text-center">
        <h3>Order ID #{{ $order->code }}</h3>
      </div>
    </div>
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
        <strong>ID:</strong> {{ $order->code }}<br>
        <strong>Tanggal:</strong> {{ \General::datetimeFormat($order->order_date) }}<br>
        <strong>Status:</strong> {{ $order->status }} {{ $order->isCancelled() ? '('. \General::datetimeFormat($order->cancelled_at) .')' : null}}
        @if ($order->isCancelled())
        <br> Cancellation Note : {{ $order->cancellation_note}}
        @endif<br>
        <strong>Payment Status:</strong> {{ $order->payment_status }}<br>
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
              <th>Description</th>
              <th>Quantity</th>
              <th>Unit Cost</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->orderItems as $item)
            <tr>
              <td>{{ $item->sku }}</td>
              <td>{{ $item->name }}</td>
              <td>{!! \General::showAttributes($item->attributes) !!}</td>
              <td>{{ $item->qty }}</td>
              <td>@currency($item->base_total)</td>
              <td>@currency($item->sub_total)</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>
@endsection