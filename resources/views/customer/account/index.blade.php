@extends('customer.master')

@section('title', '| Account')

@section('content')
<div class="container content-account px-4" style="min-height: 100vh;">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</a>
      @role('Customer')
      <a class="nav-link" id="nav-favorite-tab" data-toggle="tab" href="#nav-favorite" role="tab" aria-controls="nav-favorite" aria-selected="false">Favorite</a>
      @endrole
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active mt-4" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      {!! Form::model($user, ['method' => 'PUT', 'route' => ['account.update', $user->id ] ]) !!}
      <div class="form-group row">
        <div class="col-md-6">
          {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First name', 'required' => true]) !!}
          @error('first_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last name', 'required' => true]) !!}
          @error('last_name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-12">
          {!! Form::text('address1', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Home number and street name']) !!}
          @error('address1')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-12">
          {!! Form::text('address2', null, ['class' => 'form-control', 'placeholder' => 'Apartment, suite, unit etc. (optional)']) !!}
          @error('address2')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-6">
          {!! Form::select('province_id', $provinces, Auth::user()->province_id, ['class' => 'form-control', 'id' => 'user-province-id', 'placeholder' => '- Please Select - ', 'required' => true]) !!}
          @error('province_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::select('city_id', $cities, null, ['class' => 'form-control', 'id' => 'user-city-id', 'placeholder' => '- Please Select -', 'required' => true])!!}
          @error('city_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-6">
          {!! Form::number('postcode', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Postcode']) !!}
          @error('postcode')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="col-md-6">
          {!! Form::text('phone', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Phone']) !!}
          @error('phone')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-12">
          {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => true]) !!}
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-12">
          <input class="form-control" type="password" name="password" placeholder="Password">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <!-- Submit Form Button -->
      <div class="form-footer text-center pt-3 border-top">
        {!! Form::submit('Ubah', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
    @role('Customer')
    <div class="tab-pane fade" id="nav-favorite" role="tabpanel" aria-labelledby="nav-favorite-tab">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Hapus</th>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Harga</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($favorites as $favorite)
                  @php
                  $product = $favorite->product;
                  $product = isset($product->parent) ?: $product;
                  $image = !empty($product->productImages->first()) ? asset('storage/'.$product->productImages->first()->small) : asset('themes/ezone/assets/img/cart/3.jpg')
                  @endphp
                  <tr>
                    <td class="product-remove">
                      {!! Form::open(['url' => 'favorites/'. $favorite->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                      {!! Form::hidden('_method', 'DELETE') !!}
                      <button type="submit" style="background-color: transparent; border-color: #FFF;">X</button>
                      {!! Form::close() !!}
                    </td>
                    <td class="product-thumbnail">
                      <a href="{{ url('products/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:100px"></a>
                    </td>
                    <td class="product-name"><a href="{{ url('products/'. $product->slug) }}">{{ $product->name }}</a></td>
                    <td class="product-price-cart"><span class="amount">@currency($product->priceLabel())</span></td>
                  </tr>
                  @empty
                  <tr>
                    <td class="text-center" colspan="4">You have no favorite product</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    @endrole
  </div>
</div>
@endsection

@section('script')
<script>
  $("#user-province-id").on("change", function(e) {
    var province_id = e.target.value;

    $.get("/orders/cities?province_id=" + province_id, function(data) {
      $("#user-city-id").empty();
      $("#user-city-id").append(
        "<option value>- Please Select -</option>"
      );

      $.each(data.cities, function(city_id, city) {
        $("#user-city-id").append(
          '<option value="' + city_id + '">' + city + "</option>"
        );
      });
    });
  });
</script>
@endsection