@extends('web.layouts.layout')

@section('home-css')
<link rel="stylesheet" href="{{ asset('web/asset/css/global.css') }}">
<link rel="stylesheet" href="{{ asset('web/asset/css/contactUs.css') }}">
@endsection

@section('privacy-policy')

 <section class="banner-section" style="background-image: url('{{ asset('web/asset/images/Contacts/banner-img.webp') }}');"> 
    <div class="container"> 
        <div class="row"> 
            <h1>Terms and Conditions</h1> 
        </div> 
    </div> 
</section> 
 @endsection