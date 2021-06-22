@extends('customer.master')

@section('title', ' | Carts')

@section('content')
<div class="container" style="background-color: white;">
  <div class="shopping-cart-box">
    {!! Form::open(['url' => 'carts/update']) !!}
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header-display">
        <h2>Keranjang Belanja</h2>
        @forelse($items as $item)
        <h4 class="item-count-display ml-auto">Total Belanja: {{ $item->quantity }} item</h4>
        @empty
        @endforelse
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
                <a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
              </td>
              <td class="product-name"><a href="{{ url('product/'. $product->slug) }}">{{ $item->name }}</a></td>
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
        <div class="cart-page-total">
          <h2>Cart totals</h2>
          <ul>
            <li>Subtotal<span>{{ number_format(\Cart::getSubTotal()) }}</span></li>
            <li>Total<span>{{ number_format(\Cart::getTotal()) }}</span></li>
          </ul>
          <a class="btn btn-success" href="#">Proceed to checkout</a>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection