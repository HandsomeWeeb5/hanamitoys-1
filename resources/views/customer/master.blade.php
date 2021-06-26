<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hanami Toys @yield('title')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/customer/css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  {{-- Navbar --}}
  @include('customer.layouts.navbar')

  {{-- Content --}}
  @yield('content')

  {{-- Footer --}}
  <footer class="footer">
    Copyright 2021 - All Right reserved for Farhan Tri Budiman
  </footer>

  <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/0a9315acd2.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  {!! Toastr::message() !!}

  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });

    $(".delete").on("click", function() {
      return confirm("Do you want to remove this?");
    });

    $('.add-to-fav').on('click', function(e) {
      e.preventDefault();

      var product_slug = $(this).attr('product-slug');

      $.ajax({
        type: 'POST',
        url: '/favorites',
        data: {
          _token: $('meta[name="csrf-token"]').attr('content'),
          product_slug: product_slug
        },
        success: function(response) {
          alert(response);
        },
        error: function(xhr, textStatus, errorThrown) {
          if (xhr.status == 401) {
            alert('Login terlebih dahulu!');
            window.location.href = 'login';
          }

          if (xhr.status == 422) {
            alert(xhr.responseText);
          }
        }
      });
    });
  </script>

  @yield('script')
</body>

</html>