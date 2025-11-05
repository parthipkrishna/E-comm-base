@extends('web.layouts.layout')
@section('product-css')
<link rel="stylesheet" href="{{ asset('web/asset/css/global.css') }}">
<link rel="stylesheet" href="{{ asset('web/asset/css/product.css') }}">
@endsection
@section('products')
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
<section class="banner-section" style="background-image: url('{{ asset('web/asset/images/Product/banner-img.webp') }}');">
        <div class="container">
            <div class="row">
                <h1>Products</h1>
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
                    <button class="btn btn-white btn-sm ms-3 closeBtn" onclick="removeCartItem()">&times;</button>
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
            <div class="modal-footer d-flex justify-content-center gap-4" data-bs-dismiss="modal">
                <button id="shoppingAddToCartBtn" class="cart-btn">
                      Cart
                </button>
                <a id="checkoutBtn" href="#" onclick="showPreloaderAndRedirect()"><button class="btn checkout-btn">Checkout</button></a>
            </div>
            <div class="text-center mt-2">
                <button class="btn continue-shopping" data-bs-dismiss="modal" >Continue Shopping</button>
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
                                <h5 class="modal-title fw-bold" id="quickViewLabel">Omega 3</h5>
                                <p id="quickViewPrice" class="fs-5">
                                    <del class="text-secondary fs-6">₹12.99</del>
                                    <span class="text-success fw-bold fs-4 ms-2">₹9.78</span>
                                </p>
                                <p id="quickViewDescription" class="text-muted">
                                    Elementum eu facilisis sed odio morbi quis commodo odio. Mauris rhoncus aenean vel
                                    elit scelerisque mauris pellentesque.
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
                                <!-- <p class="mt-3 text-muted" id="quickViewDescription">
                                    <strong>Recommended usage:</strong> <span class="text-dark">3 capsules</span>
                                </p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top button -->
    <a href="#" class="float">
        <i class="fa-solid fa-filter my-float"></i>
    </a>
    <!-- product card section -->
    <section class="product-card-section">
        <div class="container mt-4">
            <div class="row">
                <!-- Sidebar Filters (Sticky) -->
                <div class="col-lg-3 mb-5">
                    <div class="stickySidebar" id="stickySidebar">
                    <form method="GET" action="{{ url()->current() }}">
                    <h5>Product Categories</h5>
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li>
                                    <input 
                                        type="checkbox" 
                                        name="category[]" 
                                        value="{{ $category->id }}" 
                                        id="category-{{ $category->id }}"
                                        {{ 
                                            (is_array(request('category')) && in_array($category->id, request('category'))) 
                                            || (request('category') && $category->id == request('category')) 
                                            ? 'checked' : '' 
                                        }}
                                    >
                                    <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="filter-btns">
                            <button type="submit" class="filter-btn">Filter</button>
                            <a href="{{ url()->current() }}" class="clear-btn text-decoration-none">Clear</a>
                        </div>
                    </form>
                    </div>
                </div>
                <!-- Products Section -->
                <div class="col-lg-9">
                    <div class="pagination mb-4">
                        <div class="">
                            <a href="index.html">Home </a>
                            <div class="underLine"></div>
                        </div>
                        <p class="ms-1"> - Products</p>
                    </div>
                    <p class="product-count" id="product-count">
                        Showing {{ $products->count() }} of {{ $products->total() }} results
                        @if(request()->has('category'))
                            for "{{ $categories->firstWhere('id', request('category'))->name ?? '' }}"
                        @endif
                    </p>
                    <div class="row" id="product-list">
                        <!-- Product Cards -->
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-6 mb-5">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="{{ $product->name }}">
                                </div>
                                <h6>{{ $product->name }}</h6>
                                <p>
                                    @if ($product->offer_price > 0)
                                        <del>{{ number_format($product->selling_price, 2) }}</del>
                                        <strong class="ms-3"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1">{{ number_format($product->offer_price, 2) }}</strong>
                                    @else
                                        <strong>{{ number_format($product->selling_price, 2) }}</strong>
                                    @endif
                                </p>
                                <input type="hidden" class="product-desc" value="{{ $product->description }}">
                                <input type="hidden" class="product-instock" value="{{ $product->in_stock }}">
                                @if ($product->quantity > 0 || $product->in_stock)
                                    <button class="addToCart" data-id="{{ $product->id }}" product-quantity="{{ $product->stock_quantity }}" data-instock="{{ $product->in_stock ? 'true' : 'false' }}"  >
                                        <i class="fa-solid fa-basket-shopping me-2"></i>Add to cart
                                    </button>
                                    <div class="quick-btn2 mt-2">
                                        <button class="quick-btn"><i class="fa-solid fa-eye me-2"></i>Quick view</button>
                                    </div>
                                @else
                            <div class="text-danger fw-bold mt-0">Out of Stock</div>
                            @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- cart to view popup -->
                    {{-- <div class="modal fade" id="cartViewModal" tabindex="-1" aria-labelledby="cartViewLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered"> <!-- smaller and centered -->
                            <div class="modal-content rounded-3 shadow-sm p-3">
                                <div class="modal-body text-center">
                                    <div class="mb-2">
                                        <i class="fa-solid fa-circle-check text-success" style="font-size: 2rem;"></i> <!-- Green tick -->
                                    </div>
                                    <h5 class="mb-1">Added to Cart</h5>
                                    <p class="text-muted"><i class="fa-solid fa-basket-shopping me-1"></i>Product has been added successfully.</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Pagination Links -->
                    <input type="hidden" id="dirham-img" value="{{ asset('web/asset/dirham.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="pagination-links mt-4">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="pagination-btns w-100 text-center">
                                            {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .pagination-links .page-item {
            margin: 0 5px;
        }
        .pagination-links .page-link {
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            background-color: #f8f9fa;
            color:#F7941D;
            transition: background-color 0.3s ease;
        }
        .pagination-links .page-item.active .page-link {
            background-color: #F7941D;
            color: white;
        }
        .pagination-links .page-item .page-link:focus {
            box-shadow: none;
        }
        .pagination {
            display: flex !important;
            justify-content: center;
            flex-wrap: wrap;
        }
        .pagination li {
            margin: 2px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- navbar script js -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!-- navbar script js end -->
    <script>
        function updateProductCount() {
            const products = document.querySelectorAll('.product-card').length;
            const totalProducts = 22; // Change this to the actual total products in database
            document.getElementById("product-count").innerText = `Showing ${products} of ${totalProducts} results`;
        }
        document.addEventListener("DOMContentLoaded", updateProductCount);

        // Sticky Sidebar Until End of Products
        window.addEventListener("scroll", function () {
            let sidebar = document.getElementById("stickySidebar");
            let productSection = document.getElementById("product-list");
            let sidebarHeight = sidebar.offsetHeight;
            let productBottom = productSection.offsetTop + productSection.offsetHeight;

            if (window.scrollY + sidebarHeight + 20 >= productBottom) {
                sidebar.classList.add("stop");
            } else {
                sidebar.classList.remove("stop");
            }
        });

        // popUp script

        let cartQuantity = 1;
        let unitPrice = 0;
        let currentShoppingProductId = null;

        function updateCartTotals() {
            const subtotal = (cartQuantity * unitPrice).toFixed(2);
            const currencyIcon = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">`;
            document.getElementById("cartSubtotal").innerHTML = `${currencyIcon}${subtotal}`;
            document.getElementById("cartTotal").innerHTML = `${currencyIcon}${subtotal}`;
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
                    const productqty = this.getAttribute("product-quantity");
                    const productInStock = this.getAttribute("data-instock") === 'true';
                    const productPriceText = productCard.querySelector("p strong").innerText.replace(/[₹,]/g, '').trim();
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
        document.querySelectorAll(".quick-btn").forEach(button => {
            button.addEventListener("click", function () {
                const productCard = this.closest(".product-card");
                const addToCartButton = this.parentElement.querySelector(".addToCart");
                const productName = productCard.querySelector("h6").innerText;
                const productImage = productCard.querySelector(".product-img").src;
                const productPrice = productCard.querySelector("p strong").innerText;
                const productDesc = productCard.querySelector(".product-desc").value;
                const productId = button.closest(".product-card").querySelector(".addToCart").dataset.id;
                const productStock = parseInt(button.closest(".product-card").querySelector(".addToCart").getAttribute("product-quantity"));
                currentQuickProductStock = productStock;


                // Store current product info
                currentQuickProductId = productId;
                currentQuickProductName = productName;
                currentQuickProductStock = productStock;

                // Fill modal content
                document.getElementById("quickViewLabel").innerText = productName;
                document.getElementById("quickViewImage").src = productImage;
                document.getElementById("quickViewPrice").innerHTML = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1"> ${productPrice}`;
                document.getElementById("quickViewDescription").innerHTML = productDesc;
                document.getElementById("quantityInput").value = 1;
                document.getElementById("quantityLimitMsg").style.display = "none";

                // Show the modal
                new bootstrap.Modal(document.getElementById("quickViewModal")).show();
            });
        });

        // Add to cart from modal
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

        // top button
        document.querySelector('.float').addEventListener('click', function (e) {
            e.preventDefault(); // Prevents the default anchor behavior
            document.getElementById('stickySidebar').classList.toggle('active');
        });
    </script>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.addToCart').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const price = this.dataset.price;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
                    console.log("Sending data:", { id, name });
    
                    fetch("{{ route('session.cart.add') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id: id,
                            name: name
                        })
                    })
                    .then(response => {
                        console.log("Response status:", response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log("Response data:", data);
                        if (data.success) {
                            const cartModal = new bootstrap.Modal(document.getElementById('cartViewModal'));
                            cartModal.show();
                        } else {
                            alert('Failed to add to session.');
                        }
                    })
                    .catch(err => {
                        console.error("AJAX error:", err);
                    });
                });
            });
        });
    </script>	 -->
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