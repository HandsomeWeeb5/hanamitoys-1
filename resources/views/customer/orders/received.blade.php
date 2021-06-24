@extends('customer.master')

@section('title', ' | Orders Checkout')

@section('content')
<div class="container" style="background: white;">
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
              <td>{{ \General::priceFormat($item->base_total) }}</td>
              <td>{{ \General::priceFormat($item->sub_total) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Pembayaran Melalui:</p>
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <br>

        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>@currency($order->base_total_price)</td>
              </tr>
              {{-- <tr>
                <th>Tax (9.3%)</th>
                <td>@currency($order->tax_amount)</td>
              </tr> --}}
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
        <a href="#" rel="noopener" target="_blank" class="btn" style="background-color: #f8f9fa; border-color: #ddd; color: #444;">
          <i class="fas fa-print"></i> Print
        </a>
        @if (!$order->isPaid())
        <a href="{{ $order->payment_url }}" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Pembayaran</a>
        @endif
        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
          <i class="fas fa-download"></i> PDF
        </button>
      </div>
    </div>
  </div>
</div>
@endsection