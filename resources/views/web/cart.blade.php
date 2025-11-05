@extends('web.layouts.layout')
@section('cart-css')
<link rel="stylesheet" href="{{ asset('web/asset/css/cartPage.css') }}">
<link rel="stylesheet" href="{{ asset('web/asset/css/global.css') }}">
@endsection
@section('cart')
<!-- banner section -->
<section class="banner-section" style="background-image: url('{{ asset('web/asset/images/cart/banner-img.webp') }}');">
        <div class="container">
            <div class="row">
                <h1>Cart</h1>
            </div>
        </div>
    </section>
    <!-- pagination -->
    <div class="container pt-5">
        <div class="pagination mb-4">
            <div class="">
                <a href="{{ route('web.home') }}">Home </a>
                <div class="underLine"></div>
            </div>
            <p class="ms-1"> - Cart</p>
        </div>
    </div>
    <!-- table section -->
    <section class="table-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-white">
                                <tr>
                                    <th style="padding-top: 20px !important;padding-bottom: 20px !important;"></th>
                                    <th style="padding-top: 20px !important;padding-bottom: 20px !important;"></th>
                                    <th style="padding-top: 20px !important;padding-bottom: 20px !important;">Product
                                    </th>
                                    <th style="padding-top: 20px !important;padding-bottom: 20px !important;">Price</th>
                                    <th style="padding-top: 20px !important;padding-bottom: 20px !important;">Quantity
                                    </th>
                                    <th style="padding-top: 20px !important;padding-bottom: 20px !important;">Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="cart-body">
                                @foreach($cart as $item)
                                    <tr class="cart-item">
                                        <td class="text-center">
                                        <button class="remove-item"
                                    data-id="{{ $item['id'] }}"
                                    style="background-color: transparent;border: 0px;font-size: 30px;">&times;</button>

                                        </td>
                                        <td class="text-center">
                                            <img class="img-fluid product-image-cart" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                        </td>
                                        <td>{{ $item['name'] }}</td>
                                        <td class="text-success price"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">{{ $item['price'] ?? 0 }}</td>
                                        <td>
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="d-flex align-items-center gap-3 justify-content-center"
                                                    style="border: 1px solid #000;border-radius: 50px;width: 150px;">
                                                    <button class="decrement" style="background-color: transparent;border: 0px;">-</button>
                                                    <input type="text" class="form-control text-center mx-2 quantity border-0"
                                                        value="{{ $item['quantity'] ?? 1 }}" style="width: 50px;" readonly>
                                                    <button class="increment" 
                                                        style="background-color: transparent;border: 0px;"
                                                        data-stock="{{ $item['stock_quantity'] ?? 0 }}"
                                                        data-in-stock="{{ $item['in_stock'] ? 'true' : 'false' }}">+</button>
                                                </div>
                                                <div class="stock-message text-danger mt-2" style="display: none;">
                                                    <h6>Maximum stock limit reached.</h6>
                                                </div>
                                            </div>
                                                <div class="stock-message text-danger mt-2" style="display: none;"><h6>Maximum stock limit reached.</h6></div>
                                            </div>
                                        </td>
                                        <td class="text-success subtotal"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="15" height="15" class="img-fluid mb-1 me-1">0</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6"></div>
                <div class="col-lg-4 col-md-6">
                    <div class="cart-summary mt-4 p-3 border rounded shadow-sm bg-white">
                        <h5 class="fw-bold">Cart Totals</h5>
                        <div class="d-flex justify-content-between mt-4">
                            <span>Subtotal</span>
                            <span id="cart-subtotal" class="text-success fw-bold"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="15" height="15" class="img-fluid mb-1 me-1">{{ $total ?? 0 }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-2">
                            <span>Total</span>
                            <span id="cart-total" class="text-success fw-bold"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="15" height="15" class="img-fluid mb-1 me-1">{{ $total ?? 0 }}</span>
                        </div>
                        <a href="{{ route('web.checkout') }}">
                            <button class="btn w-100 text-white mt-3" id="checkout-btn" style="background-color: #F7941D;">
                                Proceed to checkout
                            </button>
                        </a>
                    </div>  
                </div>
            </div>
        </div>
    </section>
    <section class="mob-table">
        @forelse($cart as $item)
            <div class="card mt-4">
                <div class="card-body">
                    <a href="javascript:void(0);" class="close-btn remove-item" data-id="{{ $item['id'] }}">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                    <div class="product text-center mb-3">
                        <img class="img-fluid" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    </div>
                    <div class="product-datas text-center">
                        <h4>{{ $item['name'] }}</h4>
                        <p class="text-success"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="15" height="15" class="img-fluid mb-1 me-1">{{ $item['price'] ?? 0 }}</p>
                        <div class="d-flex align-items-center gap-3 justify-content-center"
                            style="border: 1px solid #B4B4B4;border-radius: 50px;width: 130px;margin: 0 auto;">
                            <button class="decrement" style="background-color: transparent;border: 0px;" data-id="{{ $item['id'] }}">-</button>
                            <input type="text" class="form-control text-center quantitys border-0"
                                value="{{ $item['quantity'] ?? 1 }}" style="width: 44px;" readonly>
                            <button class="increment" style="background-color: transparent;border: 0px;" data-id="{{ $item['id'] }}" data-stock="{{ $item['stock_quantity'] }}">+</button>
                        </div>
                        <div class="stock-alert text-danger mt-2" style="display: none;">
                        Only limited stock available.
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center mt-4">Your cart is empty.</p>
            <div class="text-center">
                <a href="/products" class="btn btn-primary mt-3"; style="background-color:rgb(230, 131, 11)";>Continue Shopping</a>
            </div>
        @endforelse
        <div class="mt-4" id="mob-cart-summary">
            <h3>Cart Totals</h3>
            <div class="d-flex justify-content-between">
                <h5>Subtotal</h5>
                <h6 class="text-success"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1"><span id="mob-cart-subtotal">0</span></h6>
            </div>
        </div>
        @if(count($cart) > 0)
        <a href="{{ route('web.checkout') }}">
            <button id="mob-checkout-btn" class="btn w-100 text-white mt-3 py-2" style="background-color: #F7941D;">
                Proceed to checkout
            </button>
        </a>
        @endif
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- navbar script js -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!-- navbar script js end -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function updateCartTotals() {
                let subtotal = 0;
                const currencyIcon = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">`;
                document.querySelectorAll(".cart-item").forEach(row => {
                    let price = parseInt(row.querySelector(".price").textContent.replace("", ""));
                    let quantity = parseInt(row.querySelector(".quantity").value);
                    let itemSubtotal = price * quantity;
                    row.querySelector(".subtotal").innerHTML = `${currencyIcon}${itemSubtotal}`;
                    subtotal += itemSubtotal;
                });
                document.getElementById("cart-subtotal").innerHTML = `${currencyIcon}${subtotal}`;
                document.getElementById("mob-cart-subtotal").innerHTML = `${currencyIcon}${subtotal}`;
                document.getElementById("cart-total").innerHTML = `${currencyIcon}${subtotal}`;
            }

            document.querySelectorAll(".increment").forEach(button => {
            button.addEventListener("click", function () {
                let input = this.parentElement.querySelector(".quantity");
                let currentQty = parseInt(input.value);
                let maxStock = parseInt(this.dataset.stock);
                let isInStock = this.dataset.inStock === 'true';
                let message = this.closest('.flex-column').querySelector(".stock-message");

                // If in stock but stock quantity is 0 (unlimited), allow any quantity
                if (isInStock && maxStock === 0) {
                    input.value = currentQty + 1;
                    updateCartTotals();
                    return;
                }

                // Normal stock-limited behavior
                if (currentQty < maxStock) {
                    input.value = currentQty + 1;
                    updateCartTotals();
                    message.style.display = "none";

                    if (parseInt(input.value) === maxStock) {
                        this.disabled = true;
                        message.style.display = "block";
                    }
                } else {
                    this.disabled = true;
                    message.style.display = "block";
                }
            });
        });

        document.querySelectorAll(".decrement").forEach(button => {
            button.addEventListener("click", function () {
                let input = this.parentElement.querySelector(".quantity");
                let currentQty = parseInt(input.value);
                let incrementBtn = this.parentElement.querySelector(".increment");
                let message = this.closest('.flex-column').querySelector(".stock-message");

                if (currentQty > 1) {
                    input.value = currentQty - 1;
                    updateCartTotals();

                    // Only re-enable if not unlimited stock
                    let maxStock = parseInt(incrementBtn.dataset.stock);
                    let isInStock = incrementBtn.dataset.inStock === 'true';
                    
                    if (!(isInStock && maxStock === 0)) {
                        incrementBtn.disabled = false;
                        message.style.display = "none";
                    }
                }
            });
        });

            // Initial check for unlimited stock items
            document.querySelectorAll(".increment").forEach(button => {
                let maxStock = parseInt(button.dataset.stock);
                let isInStock = button.dataset.inStock === 'true';
                
                if (isInStock && maxStock === 0) {
                    // Hide stock message for unlimited items
                    button.closest('.flex-column').querySelector(".stock-message").style.display = "none";
                }
            });



            document.querySelectorAll(".remove-item").forEach(button => {
            button.addEventListener("click", function () {
                const row = this.closest(".cart-item");
                const productId = this.getAttribute("data-id");

                fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.remove();
                        updateCartTotals();
                        checkIfCartIsEmpty();
                        updateCartCount(data.cart_count); // <- Update the badge count
                    }
                });
            });
        });

        function checkIfCartIsEmpty() {
        const cartItems = document.querySelectorAll(".cart-item");
        if (cartItems.length === 0) {
            document.getElementById("cart-body").innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4 text-danger fs-5">
                        Your cart is empty<br>
                        <a href="/products" class="btn btn-primary mt-3"; style="background-color:rgb(230, 131, 11)";>Continue Shopping</a>
                    </td>
                </tr>
            `;
            document.querySelector(".cart-summary").classList.add("d-none");
        }
    }


        function updateCartTotals() {
            let subtotal = 0;
            document.querySelectorAll(".cart-item").forEach(row => {
                const price = parseFloat(row.querySelector(".price").textContent.replace(/[^\d.]/g, '')) || 0;
                const qty = parseInt(row.querySelector(".quantity").value) ;
                const sub = price * qty;
                subtotal += sub;
                row.querySelector(".subtotal").innerHTML = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">${sub}`;
            });

            document.getElementById("cart-subtotal").innerHTML = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">${subtotal}`;
            document.getElementById("mob-cart-subtotal").textContent = `${subtotal}`;
            document.getElementById("cart-total").innerHTML = `<img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">${subtotal}`;

            // If no items, call empty check
            if (subtotal === 0) {
                checkIfCartIsEmpty();
            }
        }
            updateCartTotals();
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const productId = row.querySelector('.remove-item').getAttribute('data-id');

            fetch('/update-cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: productId, type: 'increment' }),
            }).then(() => {
                loacation.reload();
            });
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const productId = row.querySelector('.remove-item').getAttribute('data-id');

            fetch('/update-cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: productId, type: 'decrement' }),
            }).then(() => {
               loacation.reload(); 
            });
        });
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        updateSubtotal();

        document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.parentElement.querySelector('.quantitys');
            let value = parseInt(input.value);
            const itemId = this.getAttribute('data-id');
            const stockQty = parseInt(this.getAttribute('data-stock'));

            if (value >= stockQty) {
                const stockAlert = this.closest('.card-body').querySelector('.stock-alert');
                if (stockAlert) {
                    stockAlert.style.display = 'block';
                }
            return;

            }

            input.value = value + 1;
            updateItemTotal(this);
            updateSubtotal();

            // AJAX call to update session
            updateCartSession(itemId, 'increment');
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.parentElement.querySelector('.quantitys');
            let value = parseInt(input.value);
            const itemId = this.getAttribute('data-id');

            if (value > 1) {
                input.value = value - 1;
                updateItemTotal(this);
                updateSubtotal();

                // AJAX call to update session
                updateCartSession(itemId, 'decrement');
            }
        });
    });

        document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.getAttribute('data-id');
            const cardElement = this.closest('.card');
            // AJAX call to remove item from session
            fetch('/remove-cart-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: itemId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cardElement.remove();
                    updateSubtotal();

                    if (data.empty) {
                        document.querySelector('.mob-table').innerHTML = `
                            <p class="text-center mt-4">Your cart is empty.</p>
                            <div class="text-center mt-3">
                                <a href="/products" class="btn btn-primary mt-3"; style="background-color:rgb(230, 131, 11)";>Continue Shopping</a>
                            </div>
                        `;
                    }
                } else {
                    alert('Failed to remove item.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
        function updateSubtotal() {
            let subtotal = 0;

            document.querySelectorAll('.card').forEach(card => {
                const priceText = card.querySelector('.text-success').textContent;
                const price = parseFloat(priceText.replace('', '').replace(',', ''));
                const quantity = parseInt(card.querySelector('.quantitys').value);
                subtotal += price * quantity;
            });

            document.getElementById('mob-cart-subtotal').textContent = subtotal.toFixed(2);

            const checkoutBtn = document.getElementById('mob-checkout-btn');
            checkoutBtn.disabled = document.querySelectorAll('.card').length === 0;
        }

        function updateItemTotal(button) {
            // Optional: Update per-item total display here
        }

        function updateCartSession(id, type) {
            fetch('/update-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id, type })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Something went wrong updating the cart.');
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
            });
        }
    });
</script>
	
@endsection
        