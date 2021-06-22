@extends('customer.master')

@section('title', ' | Products')

@section('content')
<div class="container content-product">
  <div class="row">
    <div class="col-md-3">
      <section class="panel">
        <header class="panel-heading">
          Filter
        </header>
        <div class="panel-body">
          <form action="{{ route('cproducts.index') }}" method="GET">
            <div class="form-group">
              <label>Anime Series</label>
              <select class="form-control" name="as" id="as">
                <option value="">-- Pilih --</option>
                @foreach($categories as $category)
                <option value="{{ $category->slug }}" {{ $category->slug == $as ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Character Name</label>
              <select class="form-control" name="cn" id="cn">
                <option value="">-- Pilih --</option>
              </select>
            </div>
            <div class="form-group">
              <label>Type Figure</label>
              <select class="form-control" name="tf">
                <option value="">-- Pilih --</option>
                @foreach($types as $type)
                <option value="{{ $type->id }}" {{ $type->id == $tf ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
              </select>
            </div>
            <button class="btn btn-primary" type="submit">Filter</button>
          </form>
        </div>
      </section>
    </div>
    <div class="products-place-wrapper col-md-9">
      <form action="{{ route('cproducts.index') }}" class="form-inline mb-3" method="GET">
        <p><span>{{ count($products) }}</span> Produk ditemukan <span>{{ $products->total() }}</span><span class="ml-5">Sort by : {{ Form::select('sort', $sorts , $selectedSort ,array('onChange' => 'this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);', 'class' => 'form-control ml-2')) }}</span></p>
      </form>
      <div class="row">
        @foreach($products as $product)
        <div class="col-12 col-lg-3 col-md-4 col-sm-6 mb-4 product-list">
          <section class="panel mb-md-3 mb-sm-3 mb-4">
            <div class="pro-img-box">
              @if ($product->productImages->first())
              <img class="img-fluid" src="{{ asset('storage/'.$product->productImages->first()->path) }}" alt="{{ $product->name }}">
              @endif
              {!! Form::open(['url' => 'carts']) !!}
              {{ Form::hidden('product_id', $product->id) }}
              {{ Form::hidden('qty', 1) }}
              <button href="{{ url('carts') }}" class="adtocart">
                <i class="fa fa-shopping-cart"></i>
              </button>
              {!! Form::close() !!}
            </div>

            <div class="panel-body text-center">
              <h4>
                <a href="{{ url('products/'. $product->slug) }}" class="pro-title">
                  {{ $product->name }}
                </a>
              </h4>
              <p class="price">@currency($product->price_label())</p>
            </div>
          </section>
        </div>
        @endforeach
      </div>
      {{ $products->links() }}
    </div>
  </div>
</div>
@endsection