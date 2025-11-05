<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEED NUTRITION | HOME</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awersome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('web/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('web/logo/Fav_icon_32X32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('web/logo/favIcon16X16') }}">
    <link rel="manifest" href="{{ asset('web/site.webmanifest') }}">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- style link -->
    @yield('home-css')
    @yield('product-css')
    @yield('cart-css')
    @yield('checkout-css')
    @yield('contact-css')
    <style>
      @keyframes slideInFromRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-slide-in {
        animation: slideInFromRight 0.6s ease-out;
    }

    .custom-alert {
        background-color: #ffffff; /* white background */
        color: #28a745;            /* Bootstrap green text */
        border: 1px solid #28a745;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 500;
        white-space: nowrap;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
    <!-- navbar section -->
    <header>
        <div class="d-flex">
            <div class="logo">
                <a href="{{ route('web.home') }}"><img class="" src="{{ asset('web/asset/images/indeed-logo.png') }}" alt=""></a>
            </div>
            <div id="overlay" class="overlay"></div>
            <nav class="nav" id="nav-menu">
                <ion-icon name="close" class="header__close" id="close-menu"></ion-icon>
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('web.home') }}" class="nav__link {{ request()->routeIs('web.home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('web.product') }}" class="nav__link {{ request()->routeIs('web.product') ? 'active' : '' }}">Products</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('web.cart') }}" class="nav__link {{ request()->routeIs('web.cart') ? 'active' : '' }}">Cart</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('web.contact') }}" class="nav__link {{ request()->routeIs('web.contact') ? 'active' : '' }}">Contact us</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="position-relative">
        <a href="{{ route('web.cart') }}" style="color: inherit;">
            <button class="btn-web position-relative">
                    <i class="fa-solid fa-basket-shopping fs-5"></i>
                    {{-- Cart Count Badge --}}
                    @php
                        $cartCount = session('temp_cart') ? count(session('temp_cart')) : 0;
                    @endphp
                    @if($cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success cart-count-badge">
                        {{ count(session('temp_cart', [])) }}
                    </span>
                    @endif
            </button>
        </a>
            {{-- Flash Message --}}
            @if(session('success'))
                <div class="custom-alert position-absolute top-50 end-100 translate-middle-y me-2 animate-slide-in" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <button class="btn-phone"><i class="fa-solid fa-basket-shopping"></i></button>
        <ion-icon name="menu" class="header__toggle" id="toggle-menu"></ion-icon>
    </header>


    @yield('index')
    @yield('products')
    @yield('cart')
    @yield('checkout')
    @yield('contact-us')
    @yield('terms-conditions')
    @yield('privacy-policy')


    <!-- footer section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 footer-frst-col">
                    <img class="img-fluid footer-img" src="{{ asset('web/asset/images/indeed-logo.webp') }}" alt="">
                    <p>{{ $companyinfo->about_short_desc ?? 'Indeed Nutrition is a trusted provider of high-quality pharmaceuticals, supplements, and wellness products focused on promoting a healthier life.' }}</p>
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
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6>Contact information</h6>
                    <div class="conatct-details mt-5">
                        <div class="contact-icons">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="flex-grow-1">
                        @php
                            $phones = explode(',', $companyinfo->phone ?? '');
                        @endphp

                        @forelse ($phones as $phone)
                            <p class="text-break mb-0">{{ trim($phone) }}</p>
                        @empty
                            <p>No phone number available</p>
                        @endforelse
                    </div>
                    </div>
                    <div class="conatct-details mt-4">
                        <div class="contact-icons">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 text-break">{{ $companyinfo->address ?? 'No address available' }}</p>
                        </div>
                    </div>
                    <div class="conatct-details mt-4">
                        <div class="contact-icons">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p>9:00 am to 5:00 pm</p>
                            <p>Monday to Saturday</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6>Shop products</h6>
                    <ul class="scroll-hidden-category">
                        @forelse($categories as $category)
                            <li>
                                <a href="{{ route('web.product', ['category[]' => $category->id]) }}">
                                    <i class="fa-solid fa-caret-right me-3"></i>{{ $category->name }}
                                </a>
                            </li>
                        @empty
                            <li>No categories found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6>Instagram</h6>
                    <div class="footer-img">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-1.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-2.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-3.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-4.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-5.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-6.webp') }}" alt="">
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <p style="color: #F7941D; font-size: 17px; font-weight: 600;">2025 © INDEED NUTRITION LLC</p>
                    <div class="footer-links mt-2 mt-md-0">
                        <a href="{{ route('web.terms-conditions') }}" class="me-3 text-decoration-none" style="color: #F7941D; font-size: 17px; font-weight: 600;">Terms & Conditions</a>
                        <a href="{{ route('web.privacy-policy') }}" class="text-decoration-none" style="color: #F7941D; font-size: 17px; font-weight: 600;">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <footer class="footer-section-phone">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6>Shop products</h6>
                    <ul class="scroll-hidden-category">
                        @forelse($categories as $category)
                            <li>
                                <a href="{{ route('web.product', ['category[]' => $category->id]) }}">
                                    <i class="fa-solid fa-caret-right me-3"></i>{{ $category->name }}
                                </a>
                            </li>
                        @empty
                            <li>No categories found</li>
                        @endforelse
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h6>Contact information</h6>
                    <div class="conatct-details mt-4">
                        <div class="contact-icons">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="flex-grow-1">
                        @php
                            $phones = explode(',', $companyinfo->phone ?? '');
                        @endphp

                        @forelse ($phones as $phone)
                            <p class="text-break mb-0">{{ trim($phone) }}</p>
                        @empty
                            <p>No phone number available</p>
                        @endforelse
                        </div>
                    </div>
                    <div class="conatct-details mt-4">
                        <div class="contact-icons">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 text-break">{{ $companyinfo->address ?? 'No address available' }}</p>
                        </div>
                    </div>
                    <div class="conatct-details mt-4">
                        <div class="contact-icons">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p>9:00 am to 5:00 pm</p>
                            <p>Monday to Saturday</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mt-4">
                    <h6>Instagram</h6>
                    <div class="footer-img">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-1.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-2.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-3.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-4.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-5.webp') }}" alt="">
                        <img class="img-fluid" src="{{ asset('web/asset/images/footer-img-6.webp') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-frst-col mt-4">
                    <img class="img-fluid footer-img" src="{{ asset('web/asset/images/indeed-logo.webp') }}" alt="">
                    <p>{{ $companyinfo->about_short_desc ?? 'Indeed Nutrition is a trusted provider of high-quality pharmaceuticals, supplements, and wellness products focused on promoting a healthier life.' }}</p>
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
                <div class="col-12 d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <p style="color: #F7941D; font-size: 17px; font-weight: 600;">2025 © INDEED NUTRITION LLC</p>
                    <div class="footer-links mt-2 mt-md-0">
                        <a href="{{ route('web.terms-conditions') }}" class="me-3 text-decoration-none" style="color: #F7941D; font-size: 17px; font-weight: 600;">Terms & Conditions</a>
                        <a href="{{ route('web.privacy-policy') }}" class="text-decoration-none" style="color: #F7941D; font-size: 17px; font-weight: 600;">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- navbar script js -->
    <script src="{{ asset('web/asset/script.js') }}"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.custom-alert');
            if (alert) alert.remove();
        }, 4000);
    </script>
<script>
    function updateCartCount(newCount) {
    const badge = document.querySelector('.cart-count-badge');
    if (badge) {
        if (newCount > 0) {
            badge.textContent = newCount;
        } else {
            badge.remove(); // Hide badge if cart is empty
        }
    }
}
</script>
    
</body>
</html>