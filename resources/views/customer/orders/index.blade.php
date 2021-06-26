@extends('customer.master')

@section('title', ' | Order')

@section('content')
<!-- Content -->
<div class="container content-transaction" style="min-height: 100vh;">
  <h3 class="title-page">TRANSACTION LIST</h3>
  <div class="mx-5 mt-5">
    <table class="table table-borderless row-gap">
      <thead>
        <th>Pembayaran</th>
        <th>Order ID</th>
        <th>Total Akhir</th>
        <th>Status</th>
        <th>Aksi</th>
      </thead>
      <tbody>
        @forelse ($orders as $order)
        <tr class="invoice-row shadow">
          <td>
            @if($order->payment_status == 'unpaid')
            <div class="btn btn-outline-danger btn-sm disabled ml-3" style="cursor: unset;">{{ $order->payment_status }}</div>
            @endif
            @if($order->payment_status == 'paid')
            <div class="btn btn-outline-success btn-sm disabled ml-3" style="cursor: unset;">{{ $order->payment_status }}</div>
            @endif
          </td>
          <td>
            {{ $order->code }}<br>
            <span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($order->order_date) }}</span>
          </td>
          <td>@currency($order->grand_total)</td>
          <td>{{ $order->status }}</td>
          <td>
            <a href="{{ url('orders/'. $order->id) }}" class="btn btn-info btn-sm">Details</a>
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
@endsection