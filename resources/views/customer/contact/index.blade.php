@extends('customer.master')

@section('title', '| Contact')

@section('content')
<div class="container" style="background: white; padding-top: 2rem; padding-bottom: 2rem">
  <div class="contact-box">
    <h2>CONTACT US / お問い合わせ</h2>
    <div class="text-group row">
      <div class="text-box1 col-md-4 col-sm-6">
        <h3>VISIT US</h3>
        <p>
          Jalan Aincrad Barat No.14 Rt.035 Rw.69, Kecamatan Pasar Ramen,
          Desa Konoha, Provinsi Akibahara.
        </p>
      </div>
      <div class="text-box2 col-md-4 col-sm-6">
        <h3>CUSTOMER SERVICE</h3>
        <p>
          Telp: 0812-420-177013 WA: 0812-8400-2664 Email:
          hanamitoys@yahoo.com
        </p>
      </div>
      <div class="text-box3 col-md-4 col-sm-12 pt-sm-4 pt-md-0">
        <h3>OPENING HOURS</h3>
        <p>Senin - Jum’at: 8am - 10pm Sabtu dan Minggu: 9am - 9pm</p>
      </div>
    </div>
    <div class="text-group2 row">
      <div class="appointment col-md-6">
        <h3>MAKE AN APPOINTMENT</h3>
        @include('admin.components.flash')
        <form action="{{ route('contact.store') }}" id="form-color" method="POST">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" id="name" name="name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" id="email" name="email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Subject" id="email" name="subject">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="message" rows="7" placeholder="Message" name="message"></textarea>
          </div>
          <div class="form-group invalid-feedback">
            Pesan yang dikirim tidak boleh kosong.
          </div>
          <div class="button-group">
            <button type="submit" class="submit-button">SUBMIT</button>
            <button type="reset" class="reset-button">CLEAR ALL</button>
          </div>
        </form>
      </div>
      <div class="
              faq-box
              col-md-6
              mt-4 mt-md-0
              font-weight-bold
              d-flex
              align-items-center
            ">
        <p>
          KAMI SUDAH SEDIAKAN PERTANYAAN DAN MASALAH YANG TELAH DIJAWAB,
          ANDA BISA CHECK SEKARANG JUGA.
          <a href="#">KLIK FAQ INI.</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection