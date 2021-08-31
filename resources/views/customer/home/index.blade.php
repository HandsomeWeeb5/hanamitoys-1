@extends('customer.master')

@section('content')
<div class="container" style="background: white; padding-bottom: 2rem">
  <div class="row">
    {{-- Carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{ asset('assets/customer/img/carousel-image1.png') }}" alt="First slide" />
          <div class="carousel-caption d-none d-md-block">
            <h5 class="caption-header">
              Toko Action Figure Anime Terpopuler
            </h5>
            <p class="caption-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Vestibulum ac urna in odio. Convallis id nunc nisl bibendum
              auctor quis platea morbi. Scelerisque dictum purus luctus eu.
              Tellus interdum ultrices consectetur aliquam. Suspendisse
              gravida augue viverra proin felis vel dictum etiam. Velit
              gravida dolor in mauris. Tincidunt laoreet dui diam aliquet.
              Nibh nisi mollis vitae vulputate. Amet et turpis in tortor
              amet varius.
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{ asset('assets/customer/img/carousel-image2.png') }}" alt="Second slide" />
          <div class="carousel-caption d-none d-md-block">
            <h5 class="caption-header">
              Toko Action Figure Anime Terpopuler
            </h5>
            <p class="caption-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Vestibulum ac urna in odio. Convallis id nunc nisl bibendum
              auctor quis platea morbi. Scelerisque dictum purus luctus eu.
              Tellus interdum ultrices consectetur aliquam. Suspendisse
              gravida augue viverra proin felis vel dictum etiam. Velit
              gravida dolor in mauris. Tincidunt laoreet dui diam aliquet.
              Nibh nisi mollis vitae vulputate. Amet et turpis in tortor
              amet varius.
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{ asset('assets/customer/img/carousel-image3.png') }}" alt="Third slide" />
          <div class="carousel-caption d-none d-md-block">
            <h5 class="caption-header">
              Toko Action Figure Anime Terpopuler
            </h5>
            <p class="caption-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Vestibulum ac urna in odio. Convallis id nunc nisl bibendum
              auctor quis platea morbi. Scelerisque dictum purus luctus eu.
              Tellus interdum ultrices consectetur aliquam. Suspendisse
              gravida augue viverra proin felis vel dictum etiam. Velit
              gravida dolor in mauris. Tincidunt laoreet dui diam aliquet.
              Nibh nisi mollis vitae vulputate. Amet et turpis in tortor
              amet varius.
            </p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    {{-- Random Box --}}
    <div class="container">
      <div class="random-box mt-5" style="width: 100%">
        <h2 class="random-box-header mb-3">Random Box Items</h2>
        <div class="row product-list">
          @foreach($products as $product)
          <div class="col-12 col-lg-3 col-md-4 col-sm-6 mb-4">
            <section class="panel mb-md-3 mb-sm-3 mb-4">
              <div class="pro-img-box">
                @if ($product->productImages->first())
                <img class="img-fluid" src="{{ asset('storage/'.$product->productImages->first()->path) }}" alt="{{ $product->name }}">
                @endif
                <a class="add-to-fav" title="Wishlist" product-slug="{{ $product->slug }}" href="">
                  <i class="far fa-heart"></i>
                </a>
              </div>

              <div class="panel-body text-center">
                <h4>
                  <a href="{{ url('products/'. $product->slug) }}" class="pro-title">
                    {{ Str::limit($product->name, 25) }}
                  </a>
                </h4>
                <p class="price">@currency($product->priceLabel())</p>
              </div>
            </section>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection