
@extends('web.layouts.layout')
@section('contact-css')
<link rel="stylesheet" href="{{ asset('web/asset/css/global.css') }}">
<link rel="stylesheet" href="{{ asset('web/asset/css/contactUs.css') }}">
@endsection
@section('contact-us')
<!-- banner section -->
<section class="banner-section" style="background-image: url('{{ asset('web/asset/images/Contacts/banner-img.webp') }}');">
        <div class="container">
            <div class="row">
                <h1>Contact us</h1>
            </div>
        </div>
    </section>
    <!-- pagination -->
    <div class="container pt-5">
        <div class="pagination">
            <div class="">
                <a href="index.html">Home </a>
                <div class="underLine"></div>
            </div>
            <p class="ms-1"> - Contact us</p>
        </div>
    </div>
    <!-- contact form section -->
    <section class="contact-section" data-aos="fade-up" data-aos-duration="500">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <h2>Have any Questions?</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus,
                        luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                    <form action="{{ route('inquiry.submit') }}" method="post">
                        @csrf
                        <div class="">
                            <label for="" class="mb-2">Your name</label>
                            <input type="text" placeholder="your name..." name="name" required>
                        </div>
                        <div class="mt-4">
                            <label for="" class="mb-2">Your email</label>
                            <input type="email" placeholder="your email..." name="email" required>
                        </div>
                        <div class="mt-4">
                            <label for="" class="mb-2">Contact Number</label>
                            <input type="text" placeholder="contact number..." name="phone" required>
                        </div>
                        <div class="mt-4">
                            <label for="" class="mb-2">Your message</label>
                            <textarea rows="5" name="message" placeholder="message..." required></textarea>
                        </div>
                        <button class="mt-3" type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-6 mt-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.1108459545803!2d76.214204175289!3d10.802821658705824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba7c5a57f84394b%3A0x769dbf0f7f9d7438!2sInnerix%20Technologies%20LLP!5e0!3m2!1sen!2sin!4v1743593766498!5m2!1sen!2sin" height="320" style="border:0;width: 100%;border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="map-details">
                        <div class="conatct-details mt-4">
                            <div class="contact-icons">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="">
                                <p>{{ $info->phone ?? 'No phone number available' }}</p>
                            </div>
                        </div>
                        <div class="conatct-details mt-4">
                            <div class="contact-icons">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="">
                                <p>{{ $info->address ?? 'No address available' }}</p>
                            </div>
                        </div>
                        <div class="conatct-details mt-4">
                            <div class="contact-icons">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="">
                                <p>9:00 am to 5:00 pm</p>
                                <p>Monday to Saturday</p>
                            </div>
                        </div>
                        <div class="socialMedia-icons">
                            @if (!empty($socialLinks['facebook']))
                                    <a href="{{ $socialLinks['facebook']->url }}"><i class="fa-brands fa-facebook"></i></a>
                                @endif
                                @if (!empty($socialLinks['youtube']))
                                    <a href="{{ $socialLinks['youtube']->url }}"><i class="fa-brands fa-youtube"></i></a>
                                @endif
                                @if (!empty($socialLinks['twitter']))
                                    <a href="{{ $socialLinks['twitter']->url }}"><i class="fa-brands fa-twitter"></i></a>
                                @endif
                                @if (!empty($socialLinks['instagram']))
                                    <a href="{{ $socialLinks['instagram']->url }}"><i class="fa-brands fa-instagram"></i></a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
@endsection
        
        
        
 	