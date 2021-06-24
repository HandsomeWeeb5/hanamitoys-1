@extends('customer.master')

@section('title', ' | Products')

@section('content')
<div class="container" style="background-color: white;">
  <div class="row py-5">
    <div class="col-md-6">
      @forelse ($product->productImages as $image)
      <img class="img-fluid" src="{{ asset('storage/'.$image->large) }}" alt="{{ $product->name }}">
      @empty
      No image found!
      @endforelse
    </div>
    <div class="col-md-6">
      <h3 class="mb-4">{{ $product->name }}</h3>
      <p class="mb-3">{{ $product->description }}</p>
      <div class="filter mb-3">
        @php
        $i = 0;
        $s = 0;
        @endphp
        <p class="mb-1">Anime Series : <a href="{{ url('products'. $product->categories ? 'products?as=' . $product->categories[$s++]->slug : '' ) }}">{{ $product->categories ? $product->categories[$i++]->name : '' }}</a></p>
        <p class="mb-1">Anime Character : <a href="{{ url('products' . $product->categories ? 'products?cn=' . $product->categories[$s++]->slug : '' ) }}">{{ $product->categories ? $product->categories[$i++]->name : '' }}</a></p>
      </div>
      <h4 class="mb-4">@currency($product->priceLabel())</h4>
      {!! Form::open(['url' => 'carts']) !!}
      {{ Form::hidden('product_id', $product->id) }}
      @if ($product->type == 'configurable')
      <div class="quick-view-select">
        <div class="select-option-part">
          <label>Types*</label>
          {!! Form::select('type', $types , null, ['class' => 'select', 'placeholder' => '- Please Select -', 'required' => true]) !!}
        </div>
      </div>
      @endif
      <div class="adding-product d-flex">
        <div class="quantity-box mb-4">
          <input type="number" name="qty" class="quantity" value="1">
        </div>
        <div class="add-to-cart-btn">
          <button type="submit" class="btn btn-custom">Add To Cart</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection