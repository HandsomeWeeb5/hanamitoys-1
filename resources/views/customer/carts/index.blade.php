@extends('customer.master')

@section('title', ' | Carts')

@section('content')
<div class="container " style="background-color: white; padding-bottom: 2rem;">
  <div class="shopping-cart-box">
    {!! Form::open(['url' => 'carts/update']) !!}
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header-display">
        <h2>Keranjang Belanja</h2>
        <h4 class="item-count-display ml-auto">Total Belanja: {{ number_format(\Cart::getTotalQuantity()) }} item</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table table-striped">
          <thead class="column-header">
            <tr>
              <th>Hapus</th>
              <th>Gambar</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($items as $item)
            @php
            $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
            $image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
            @endphp
            <tr>
              <td class="text-center" style="vertical-align: middle;">
                <a href="{{ url('carts/remove/'. $item->id)}}" class="delete"><i class="fas fa-times"></i></a>
              </td>
              <td class="product-thumbnail">
                <a href="{{ url('products/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
              </td>
              <td class="product-name"><a href="{{ url('products/'. $product->slug) }}">{{ $item->name }}</a></td>
              <td class="product-price-cart"><span class="amount">{{ number_format($item->price) }}</span></td>
              <td class="product-quantity">
                {{-- <input class="form-control" value="{{ $item->quantity }}" type="number" min="1"> --}}
                {!! Form::number('items['. $item->id .'][quantity]', $item->quantity, ['min' => 1, 'required' => true, 'class' => 'form-control']) !!}
              </td>
              <td class="product-subtotal">{{ number_format($item->price * $item->quantity)}}</td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="6">Keranjang Kosong!</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="coupon-all d-flex">
          <div class="coupon2 ml-auto">
            <input class="btn btn-custom" name="update_cart" value="Update cart" type="submit">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5 ml-auto">
        <div style="padding-top: 50px;">
          <h2 style="font-size: 25px; font-weight: 700; margin-bottom: 20px; text-transform: capitalize;">Cart totals</h2>
          <ul style="border: 1px solid #ddd; padding: 0; margin: 0;">
            <li style="border-bottom: 1px solid #ddd; color: #555; font-size: 15px; font-weight: bold; padding: 10px 30px; list-style: none;">Subtotal<span style="float: right;">{{ number_format(\Cart::getSubTotal()) }}</span></li>
            <li style="border-bottom: none; color: #555; font-size: 15px; font-weight: bold; padding: 10px 30px; list-style: none;">Total<span style="float: right;">{{ number_format(\Cart::getTotal()) }}</span></li>
          </ul>
          <a class="btn btn-success mt-4" href="{{ url('orders/checkout') }}">Proceed to checkout</a>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/customer/js/app.js') }}"></script>
@endsection