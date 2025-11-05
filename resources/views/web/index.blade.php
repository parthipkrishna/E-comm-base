@extends('web.layouts.layout')
@section('home-css')
<link rel="stylesheet" href="{{ asset('web/asset/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('web/asset/css/global.css') }}">
@endsection
@section('index')
 <div id="preloader" style="display: none;">
    <div id="status">
        <div class="bouncing-loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<!-- banner section -->
    <section class="main-section">
    @if ($data['banners']->count())
        @foreach($data['banners'] as $banner)
                <section class="banner-section-home active" id="banner{{ $banner->id }}"
                    style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <h1>{{ $banner->title ?? 'Your Trusted Partner in Health & Wellness' }}</h1>
                                <p>{{ $banner->sub_title ?? 'Crafted for your daily well-being. The right ingredients at optimal strength for essential, everyday nutrition to support a healthy lifestyle.' }}</p>
                                <a href="{{ $banner->cta_url ?? '#' }}">
                                    <button>{{ $banner->cta_text ?? 'Shop now' }}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        @else
        {{-- Default Banner --}}
        <section class="banner-section-home active" id="banner1"
            style="background-image: url('{{ asset('web/asset/images/home/banner-img.webp') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <h1>Your Trusted Partner <br>in Health & Wellness</h1>
                        <p>Crafted for your daily well-being. The right ingredients at optimal strength for essential,
                            everyday nutrition to support a healthy lifestyle.</p>
                        <a href="{{ route('web.product') }}"><button>Shop now</button></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="banner-section-home" id="banner2"style="background-image: url('{{ asset('web/asset/images/home/banner-img-2.webp') }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1>Your Trusted Partner <br>in Health & Wellness</h1>
                            <p>Crafted for your daily well-being. The right ingredients at optimal strength for essential,
                                everyday nutrition to support a healthy lifestyle.</p>
                            <a href="{{ route('web.product') }}"><button>Shop now</button></a>
                        </div>
                    </div>
                </div>
            </section>
        @endif    
    </section>
    <!-- health section -->
    <section class="health-section" data-aos="fade-up" data-aos-duration="500">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Your Trusted Partner in Health & Wellness</h2>
                    <p class="intro">{!! $companyinfo->company_intro ?? 'Crafted for your daily well-being. The right ingredients at optimal strength for essential, everyday nutrition to support a healthy lifestyle. Crafted for your daily well-being. The right ingredients at optimal strength for essential, everyday nutrition to support a healthy lifestyle.' !!}</p>
                </div>
                <div class="col-lg-6">
                <img class="img-fluid" src="{{ $companyinfo && $companyinfo->intro_image ? asset('storage/' . $companyinfo->intro_image) : asset('web/asset/images/home/health-img.webp') }}" alt="Health Image">
                </div>
            </div>
        </div>
    </section>
    <!-- product categories -->
    <section class="product-section" data-aos="fade-up" data-aos-duration="500">
    <div class="container-fluid">
        <h2>Product Categories</h2>
        <div class="category-scroll-wrapper">
        <div class="row justify-content-between mx-5">
            @forelse ($data['categories'] as $category)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 px-2">
                    <a href="{{ route('web.product', ['category[]' => $category->id]) }}" class="text-decoration-none">
                        <div class="product-details">
                            <div class="mt-4 product-categories-img text-center">
                                <img class="img-fluid" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                <p>{{ $category->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p>No categories found</p>
                </div>
            @endforelse
        </div>
        </div>
    </div>
</section>

    <!-- Add to cart -->
    <div class="modal fade addtocart" id="shoppingCartModal" tabindex="-1" aria-labelledby="shoppingCartLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header cart-header">
                    <h5 class="modal-title" id="shoppingCartLabel">Shopping cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cart-item d-flex align-items-center">
                        <img id="cartProductImage" src="" class="cart-img me-3" alt="Product">
                        <div>
                            <h6 id="cartProductName"></h6>
                            <p id="cartProductPrice" class="price-text"></p>
                        </div>
                        <div class="ms-auto quantity-controls">
                            <button class="btn btn-white btn-md" onclick="decreaseCartQuantity()">-</button>
                            <span id="cartQuantity" class="mx-2">1</span>
                            <button class="btn btn-white btn-md" onclick="increaseCartQuantity()">+</button>
                        </div>
                        <button class="btn btn-white btn-sm ms-3 closeBtn" onclick="removeCartItem()"></button>
                    </div>
                    <div id="modal-stock-message" class="text-danger mt-2" style="display: none;">Maximum stock limit reached.</div>
                    <div class="cart-summary mt-4">
                        <div class="d-flex justify-content-between">
                            <p>Subtotal:</p>
                            <p><strong id="cartSubtotal"></strong></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>Total:</p>
                            <p><strong id="cartTotal"></strong></p>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="productqty">
                <input type="hidden" id="product_instock" value="true">
                <div class="modal-footer d-flex justify-content-center gap-4">
                    <button id="shoppingAddToCartBtn" class="cart-btn" data-bs-dismiss="modal">
                         Cart
                    </button>
                    <a id="checkoutBtn" href="#" onclick="showPreloaderAndRedirect()"><button class="btn checkout-btn">Checkout</button></a>
                </div>
                <div class="text-center mt-2">
                    <button class="btn continue-shopping" data-bs-dismiss="modal">Continue Shopping</button>
                </div>
            </div>
        </div>
    </div>
    <!-- quick to view popup -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-5">
                                <img id="quickViewImage" src="" class="img-fluid rounded" alt="Product">
                            </div>
                            <div class="col-lg-7">
                                <h5 class="modal-title fw-bold" id="quickViewLabel"></h5>
                                <p id="quickViewPrice" class="fs-5">
                                    <del class="text-secondary fs-6 fw-bold"></del>
                                    <span class="text-success fw-bold fs-4 ms-2"></span>
                                </p>
                                <p id="quickViewDescription" class="text-muted  fw-bold">
                                </p>
                                <!-- Quantity Selector -->
                                <div class="d-flex flex-wrap align-items-center mt-3 gap-3">
                                    <!-- Quantity Box -->
                                    <div class="d-flex align-items-center border rounded-pill px-3 py-2"
                                        style="background-color: transparent;">
                                        <button class="btn p-0 px-2" style="border: none; background: transparent;"
                                            onclick="decreaseQuantity()">-</button>
                                        <input type="text" id="quantityInput" value="2"
                                            class="form-control text-center border-0 shadow-none p-0 mx-2"
                                            style="width: 40px; background-color: transparent;" readonly>
                                        <button class="btn p-0 px-2" style="border: none; background: transparent;"
                                            onclick="increaseQuantity()">+</button>
                                    </div>
                                    <!-- Quantity limit message -->
                                    <p id="quantityLimitMsg" class="text-danger fw-bold mt-2" style="display: none;">Only limited stock available.</p>
                                    <!-- Add to Cart Button -->
                                        <button class="btn text-white rounded-pill px-4 py-2"
                                            style="background-color: #F7941D;" id="quickAddToCartBtn">
                                            <i class="fa-solid fa-basket-shopping me-2"></i> Add to cart
                                        </button>
                                </div>
                                <!-- Recommended Usage -->
                                <p class="mt-3 text-muted">
                                    <strong>Recommended usage:</strong> <span class="text-dark">3 capsules</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popular product section -->
    <section class="popular-product">
    <div class="container-fluid">
        <div class="row mb-3 mx-5">
            <div class="col-12">
                <h2>Popular Products</h2>
            </div>
            <div class="col-12 text-end">
                <a href="{{ route('web.product') }}">View all</a>
            </div>
        </div>
        
        <div class="products-scroll-container">
            <div class="products-scroll-wrapper">
                @foreach ($data['products'] as $product)
                <div class="product-card-wrapper">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="Omega 3">
                        </div>
                        <h6>{{ $product->name }}</h6>
                        <p class="mb-1">THC 140.0-200.0mg/g</p>
                        <p class="mb-1">THC 150.0-200.0mg/g</p>
                        <p><del>{{ number_format($product->unit_price, 2) }}</del> <strong class="my-5"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1">{{ number_format($product->selling_price, 2) }}</strong></p>
                        @if ($product->quantity > 0 || $product->in_stock)
                        <div class="d-flex gap-4">
                            <button class="addToCart" data-id="{{ $product->id }}" product-quantity="{{ $product->stock_quantity }}" data-instock="{{ $product->in_stock ? 'true' : 'false' }}" >
                                <i class="fa-solid fa-basket-shopping me-2"></i>Add to cart
                            </button>
                            <button class="quick-btn"><i class="fa-solid fa-eye me-2"></i></button>
                        </div>
                        @else
                    <div class="text-danger fw-bold mt-2">Out of Stock</div>
                    @endif
                        <input type="hidden" class="product-desc" value="{{ $product->description }}">
                        <input type="hidden" class="product-quantity" value="{{ $product->stock_quantity }}">
                        <input type="hidden" class="product-instock" value="{{ $product->in_stock }}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
    <!-- cart to view popup -->
    {{-- <div class="modal fade" id="cartViewModal" tabindex="-1" aria-labelledby="cartViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered"> 
            <div class="modal-content rounded-3 shadow-sm p-3">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <i class="fa-solid fa-circle-check text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="mb-1">Added to Cart</h5>
                    <p class="text-muted"><i class="fa-solid fa-basket-shopping me-1"></i>Product has been added successfully.</p>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- Approach Section --}}
    @php
        $approach = $data['homesections']->firstWhere('type', 'approach');
    @endphp

    @if ($approach)
        <section class="approch-section" data-aos="fade-up" data-aos-duration="500" style="background-image: url('{{ asset('storage/' . $approach->bg_image) }}');">
            <div class="container">
                <div class="row flex-column flex-md-row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-7">
                        <h3>{{ $approach->title }}</h3>
                        <p>{{ $approach->short_desc }}</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-5 approach-img">
                        <img class="img-fluid" src="{{ asset('storage/' . $approach->mockup_image) }}" alt="{{ $approach->title }}">
                    </div>
                </div>
            </div>
        </section>

        <section class="approch-section-mob" style="background-image: url('{{ asset('storage/' . $approach->bg_image) }}');">
            <div class="approch-section-contents">
                <h3>{{ $approach->title }}</h3>
                <p>{{ $approach->short_desc }}</p>
            </div>
            <div class="approach-img">
                <img class="img-fluid" src="{{ asset('storage/' . $approach->mockup_image) }}" alt="{{ $approach->title }}">
            </div>
        </section>
    @endif

    {{-- Introduction Sections --}}
    @foreach ($data['homesections']->where('type', 'intro') as $section)
        <section class="introduction-section" data-aos="fade-up" data-aos-duration="500" style="background-image: url('{{ asset('storage/' . $section->bg_image) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="container">
                <div class="row h-full align-items-center">
                    <div class="col-lg-4 introduction-img">
                        <img class="img-fluid" src="{{ asset('storage/' . $section->mockup_image) }}" alt="{{ $section->title }}">
                    </div>
                    <div class="col-lg-8">
                        <h3>{{ $section->title }}</h3>
                        <p>{{ $section->short_desc }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    <!-- approch section -->
    <!-- <section class="approch-section" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-7">
                    <h3>A balanced approachto heart and bone health</h3>
                    <p>Vitamin K2 and D3, along with EPA and DHA Omega-3s, are crucial nutrients often lacking in modern
                        diets. These vitamins are most beneficial when combined with heart-healthy fats like Omega-3s
                        found in fish oil</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-5 approach-img">
                    <img class="img-fluid" src="{{ asset('web/asset/images/home/products-img-1.webp') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="approch-section-mob scnd-approch">
        <div class="approch-section-contents">
            <h3>A balanced approachto heart and bone health</h3>
            <p>Vitamin K2 and D3, along with EPA and DHA Omega-3s, are crucial nutrients often lacking in modern
                diets. These vitamins are most beneficial when combined with heart-healthy fats like Omega-3s
                found in fish oil</p>
        </div>
        <div class="approach-img">
            <img class="img-fluid" src="{{ asset('web/asset/images/home/products-img-1.webp') }}" alt="">
        </div>
    </section> -->
    <!-- introduction section -->
    
    <!-- faq section -->
    <section class="faq-section" data-aos="fade-up" data-aos-duration="500">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ asset('web/asset/images/home/faq-img.webp') }}" alt="">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-3">The Effects of Cannabis on Body</h2>
                    <div class="accordion" id="faqAccordion">
                         @if($data['faqs']->count() > 0)
                             @foreach($data['faqs'] as $index => $faq)
                                @php
                                    $headingId = 'heading' . ($index + 1);
                                    $collapseId = 'collapse' . ($index + 1);
                                    $isFirst = $index === 0;
                                @endphp  
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header" id="{{ $headingId }}">
                                        <button class="accordion-button shadow-none {{ $isFirst ? '' : 'collapsed' }}" type="button" 
                                            data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" 
                                            aria-expanded="{{ $isFirst ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                                            {{ $faq->question }} <span class="icon"></span>
                                        </button>
                                    </h2>
                                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}" 
                                        aria-labelledby="{{ $headingId }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                No FAQs found
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Questions section -->
    <section class="questions-section" data-aos="fade-up" data-aos-duration="500">
        <div class="container">
            <h2>Have any Questions?</h2>
            <div class="question-card">
                @if ($data['companyinfo'])
                    <!-- Address Section -->
                    <div class="info-card mt-5">
                        <h5><strong>Our Office Location</strong></h5>
                        <p><i class="fas fa-map-marker-alt"></i> {{ $data['companyinfo']->address ?? 'No address available' }}</p>
                        <p>We are always here to help you at our physical location.</p>
                    </div>
                    <div class="info-card dark mt-5">
                        <h5><strong>Our Office Location</strong></h5>
                        <p><i class="fas fa-check"></i> Orci nulla pellentesque dignissim</p>
                        <p><i class="fas fa-check"></i> Nam at lectus urna duis convallis</p>
                        <p><i class="fas fa-check"></i> Quis auctor elit sed vulputate</p>
                    </div>
                        <!-- Phone Section -->
                    <div class="info-card mt-5">
                        <h5><strong>Our Phone</strong></h5>
                        <p><i class="fas fa-phone-alt"></i> {{ $data['companyinfo']->phone ?? 'No phone number available' }}</p>
                        <p>Feel free to call us anytime during business hours.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <style>
        .category-scroll-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
        }
        .category-scroll-wrapper::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Edge */
        }
        .category-scroll-wrapper .row {
            flex-wrap: nowrap;
        }
        .category-scroll-wrapper .col-6,
        .category-scroll-wrapper [class^="col-"] {
            flex: 0 0 auto;
        }
    .products-scroll-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }
    @media (min-width: 992px) {
        .col-lg-custom-5 {
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
    .products-scroll-wrapper {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Firefox */
        padding-bottom: 10px; /* Space for potential scrollbar */
        gap: 30px;
    }

    .products-scroll-wrapper::-webkit-scrollbar {
        display: none; /* Hide scrollbar for Chrome, Safari and Opera */
    }

    .product-card-wrapper {
        flex: 0 0 auto;
        width: 250px; /* Fixed width for each product card */
    }

    /* Make sure product cards take full width of their wrapper */
    .product-card {
        width: 110%;
        height: 100%;
    }
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-card-wrapper {
            width: 200px;
        }
    }

    @media (max-width: 576px) {
        .product-card-wrapper {
            width: 170px;
        }
        @media (max-width: 768px) {
        .product-card img.img-fluid {
            width: 10px;  /* Reduce the size on mobile */
            height: 8px;
            margin-top: 3px
        }
    }
    }
</style>
    <!-- navbar script js end -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // slider slider
        document.addEventListener("DOMContentLoaded", function () {
            let banners = document.querySelectorAll(".banner-section-home");
            let index = 0;

            function showNextBanner() {
                banners.forEach((banner, i) => {
                    banner.classList.remove("active");
                });

                banners[index].classList.add("active");
                index = (index + 1) % banners.length;
            }

            showNextBanner();
            setInterval(showNextBanner, 5000); // Change slide every 5 seconds
        });
        // popUp script
        let cartQuantity = 1;
        let unitPrice = 0;
        let currentShoppingProductId = null;

        function updateCartTotals() {
            const subtotal = (cartQuantity * unitPrice).toFixed(2);
            const currencyIcon = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">`;
            document.getElementById("cartSubtotal").innerHTML = `${currencyIcon} ${subtotal}`;
            document.getElementById("cartTotal").innerHTML = `${currencyIcon} ${subtotal}`;
            document.getElementById("cartQuantity").innerText = cartQuantity;
        }

        function increaseCartQuantity() {
            const maxQty = parseInt(document.getElementById("productqty").value);
            const isInStock = document.getElementById("product_instock").value === 'true';

             // Unlimited stock case
            if (isInStock && maxQty === 0) {
                cartQuantity++;
                updateCartTotals();
                hideStockLimitMessage();
                return;
            }
            
            // Out of stock case
            if (maxQty === 0 && !isInStock) {
                showStockLimitMessage();
                return;
            }
            
            // Normal limited stock case
            if (cartQuantity < maxQty) {
                cartQuantity++;
                updateCartTotals();

                if (cartQuantity === maxQty) {
                    showStockLimitMessage(); // Show immediately when reaching max
                } else {
                    hideStockLimitMessage(); // Hide if not yet at max
                }
            }

        }

        function decreaseCartQuantity() {
            if (cartQuantity > 1) {
                cartQuantity--;
                updateCartTotals();
                hideStockLimitMessage();
            }
        }

        function showStockLimitMessage() {
            let msg = document.getElementById("modal-stock-message");
            if (msg) msg.style.display = "block";
        }

        function hideStockLimitMessage() {
            let msg = document.getElementById("modal-stock-message");
            if (msg) msg.style.display = "none";
        }


        function removeCartItem() {
            cartQuantity = 1;
            unitPrice = 0;
            document.getElementById("cartProductName").innerText = "";
            document.getElementById("cartProductImage").src = "";
            document.getElementById("cartProductPrice").innerText = "";
            document.getElementById("cartSubtotal").innerText = "";
            document.getElementById("cartTotal").innerText = "";
            document.getElementById("cartQuantity").innerText = "1";
            let modal = bootstrap.Modal.getInstance(document.getElementById("shoppingCartModal"));
            modal.hide();
        }

        // Function to get cart from session via AJAX
        async function getCartFromSession() {
            try {
                const response = await fetch('/get-cart'); // You'll need to create this endpoint
                const cart = await response.json();
                return cart;
            } catch (error) {
                console.error('Error fetching cart:', error);
                return [];
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const addToCartButtons = document.querySelectorAll(".product-card .addToCart");

            addToCartButtons.forEach(button => {
                button.addEventListener("click", async function () {
                    const productCard = this.closest(".product-card");
                    const productId = this.getAttribute("data-id");
                    const productName = productCard.querySelector("h6").innerText;
                    const productImage = productCard.querySelector(".product-img").src;
                    const productPriceText = productCard.querySelector("p strong").innerText.replace(/[AED ,]/g, '').trim();
                    const productqty = this.getAttribute("product-quantity");
                    const productInStock = this.getAttribute("data-instock") === 'true';
                    unitPrice = parseFloat(productPriceText);

                    // Get current cart from session
                    const cart = await getCartFromSession();
                    
                    // Check if product already exists in cart
                    const existingItem = cart.find(item => item.id == productId);
                    
                    // Set quantity to existing quantity + 1 if exists, otherwise 1
                    cartQuantity = existingItem ? parseInt(existingItem.quantity) : 1;
                    
                    currentShoppingProductId = productId;
                    currentShoppingProductName = productName;

                    document.getElementById("cartProductName").innerText = productName;
                    document.getElementById("cartProductImage").src = productImage;
                    document.getElementById("cartProductPrice").innerHTML = `
                    <img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">
                    ${unitPrice.toFixed(2)}`;

                    document.getElementById("productqty").value = productqty;
                    document.getElementById("product_instock").value = productInStock;
                    updateCartTotals();

                    let shoppingCartModal = new bootstrap.Modal(document.getElementById("shoppingCartModal"));
                    shoppingCartModal.show();
                });
            });
        });

        // quick popup script
        let currentQuickProductId = null;
        let currentQuickProductName = null;
        let currentQuickProductStock = null;
        document.addEventListener("DOMContentLoaded", function () {
            const quickViewButtons = document.querySelectorAll(".quick-btn");

            quickViewButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const productCard = this.closest(".product-card");
                    const addToCartButton = this.parentElement.querySelector(".addToCart");

                    // Extract product details
                    const productName = productCard.querySelector("h6").innerText;
                    const productImage = productCard.querySelector(".product-img").src;
                    const productPrice = productCard.querySelector("p strong").innerText;
                    const productsdesc = productCard.querySelector(".product-desc").value;
                    const productId = button.closest(".product-card").querySelector(".addToCart").dataset.id;
                    const productStock = parseInt(addToCartButton.getAttribute("product-quantity"));
                    currentQuickProductStock = productStock;
                    // Store current product info
                    currentQuickProductId = productId;
                    currentQuickProductName = productName;
                    currentQuickProductStock = productStock;
                    // Update modal content
                    document.getElementById("quickViewLabel").innerText = productName;
                    document.getElementById("quickViewImage").src = productImage;
                    document.getElementById("quickViewPrice").innerHTML = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1"> ${productPrice}`;
                    document.getElementById("quickViewDescription").innerHTML = productsdesc;
                    document.getElementById("quantityInput").value = 1;
                    document.getElementById("quantityLimitMsg").style.display = "none";

                    // Show the modal
                    let quickViewModal = new bootstrap.Modal(document.getElementById("quickViewModal"));
                    quickViewModal.show();
                });
            });
        });
        document.getElementById("quickAddToCartBtn").addEventListener("click", function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const quantity = parseInt(document.getElementById("quantityInput").value);

            fetch("{{ route('session.cart.add') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: currentQuickProductId,
                    name: currentQuickProductName,
                    quantity: quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // const cartModal = new bootstrap.Modal(document.getElementById('cartViewModal'));
                    // cartModal.show();
                    window.location.href = "{{ route('web.cart') }}";
                } else {
                    alert("Failed to add product to cart.");
                }
            })
            .catch(err => console.error("Error:", err));
        });

        function decreaseQuantity() {
            let quantityInput = document.getElementById("quantityInput");
            let currentValue = parseInt(quantityInput.value);

            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                document.getElementById("quantityLimitMsg").style.display = "none";
            }
        }


        function increaseQuantity() {
            let quantityInput = document.getElementById("quantityInput");
            let currentValue = parseInt(quantityInput.value);

            if (currentQuickProductStock === 0 || currentValue < currentQuickProductStock) {
                quantityInput.value = currentValue + 1;
                document.getElementById("quantityLimitMsg").style.display = "none"; // hide limit message
            } else {
                // show warning
                document.getElementById("quantityLimitMsg").style.display = "block";
            }
        }
    </script>
    <script>
    document.getElementById("shoppingAddToCartBtn").addEventListener("click", function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const quantity = parseInt(document.getElementById("cartQuantity").innerText) || 1;
        const productId = currentShoppingProductId; // you must set this when opening the modal
        const productName = currentShoppingProductName;

        fetch("{{ route('session.cart.add') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id: productId,
                name: productName,
                quantity: quantity
            })
        })
        .then(res => res.json())
        .then(data => {
            window.location.href = "{{ route('web.cart') }}";
        })
        .catch(err => {
            console.error("Error:", err);
            alert("Failed to add item to cart.");
        });
    });

    document.getElementById("checkoutBtn").addEventListener("click", function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const productId = currentShoppingProductId;
    const quantity = parseInt(document.getElementById("cartQuantity").innerText) || 1;
    const productName = currentShoppingProductName;

    fetch("{{ route('session.cart.add') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: productId,
            name: productName,
            quantity: quantity
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = "{{ route('web.checkout') }}";
        } else {
            alert("Failed to proceed to checkout.");
        }
    })
    .catch(err => {
        console.error("Error:", err);
        alert("Something went wrong.");
    });
});

</script>
<script>
    let cartQuantity = 1;

    function updateCartQuantityDisplay() {
        document.getElementById("cartQuantity").innerText = cartQuantity;
    }

    function increaseCartQuantity() {
        cartQuantity++;
        updateCartQuantityDisplay();
    }

    function decreaseCartQuantity() {
        if (cartQuantity > 1) {
            cartQuantity--;
            updateCartQuantityDisplay();
        }
    }

    // Optional: Reset quantity to 1 each time the modal opens
    const shoppingCartModalEl = document.getElementById("shoppingCartModal");
    shoppingCartModalEl.addEventListener("show.bs.modal", function () {
        cartQuantity = 1;
        updateCartQuantityDisplay();
    });
</script>
<script>
    document.getElementById('checkoutBtn')?.addEventListener('click', function() {
        document.getElementById('preloader').style.display = 'block';
    });

    window.addEventListener('load', function() {
        document.getElementById('preloader').style.display = 'none';
    });

    setTimeout(function() {
        document.getElementById('preloader').style.display = 'none';
    }, 5000);
</script>
@endsection      