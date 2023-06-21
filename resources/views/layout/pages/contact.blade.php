@extends('layout.base')

@section('content')
<style>
.hero-container {
  display: flex;
  padding: 5% 10%;

}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{asset('image/banner_mypage.jpg')}}");
  min-height: 300px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
    position: absolute;
  text-align: center;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

.hero-text h1 {
  font-size: 40px;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  background-color: #ddd;
  text-align: center;
  cursor: pointer;
}

.hero-text button:hover {
  background-color: #555;
  color: white;
}

.hero-left, .hero-right {
  width: 50%;
}

@media only screen and (max-width: 600px) {
  .hero-container {
    flex-direction: column;
  }
  .hero-text h1 {
  font-size: 20px;
}
  .hero-left, .hero-right {
    width: 100%;
  }
}

.full-screen-map {
  width: 100%;
  height: 100%;
  border: none;
}
</style>
<section class="fv relative -mt-[50px] md:mt-0 mb-[50px] md:mb-25">
        <div class="fv-slider relative h-[260px]">
            <img src="{{ asset('image/banner.png') }}" class="w-full h-full object-cover">
            <div class="fvInner w-[96%] lg:w-full text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-9">
                <p class="font-serif font-semibold text-xl lg:text-[40px] lg:leading-[57px] tracking-widest text-white mb-9"
                    style="text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                <span class="notranslate">Job - Visa</span>
                </p>
                    <p class="font-serif font-semibold text-xl lg:text-[40px] lg:leading-[57px] tracking-widest text-white mb-9"
                    style="text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                    <span class="notranslate">Japan</span></p>
            </div>
        </div>
    </section>
<div>
    <div class="container">
      <div class="heading">
        <h1>Liên hệ</h1>
        <div class="contact">
          <a href="https://www.facebook.com/thanhgiangseikou">
            <img src="{{asset('image/facebook.svg')}}">
          </a>
          <a href="https://www.messenger.com/t/383063642069568">
            <img src="{{asset('image/messenge.svg')}}">
          </a>
        </div>
      </div>
    </div>
    <div class="hero-container">
      <div class="hero-left">
        <div class="hero-image">
          <div class="hero-text">
            <h1>Công ty TNHH <span class="notranslate"> SEIKOU T&T</span></h1>
            <p>〒169-0073 Tòa nhà Narita 401, 1-17-6 Hyakuncho, Shinjuku-ku, Tokyo</p>
            <p>TEL: 03-6313-4267</p>
            <p>Hotline: 080-1175-5868</p>
            <p>Email: thanhgiangseikou@gmail.com</p>
          </div>
        </div>
      </div>
      <div class="hero-right">
          <iframe class="full-screen-map" src="https://www.google.com/maps?q=〒169-0073%20
            東京都新宿区百人町２丁目１８&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>
</div>




@stop

@section('js')
<script src="{{ asset('js/home.js') }}"></script>
@endsection
