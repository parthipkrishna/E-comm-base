@extends('web.layouts.layout')
@section('checkout-css')
<link rel="stylesheet" href="{{ asset('web/asset/css/checkOut.css') }}">
<link rel="stylesheet" href="{{ asset('web/asset/css/global.css') }}">
@endsection
@section('checkout')
<!-- banner section -->
<section class="banner-section" style="background-image: url('{{ asset('web/asset/images/checkOut/banner-img.webp') }}');">
        <div class="container">
            <div class="row">
                <h1>Check out</h1>
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
            <p class="ms-1"> - Check out</p>
        </div>
    </div>
        <!-- contact form section -->
        <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <h2>Billing details</h2>
                    <form action="{{ route('place.order') }}" method="POST" id="mainCheckoutForm" novalidate>
                        @csrf
                        <div class="firstLast-name">
                            <div>
                                <label class="mb-2">First Name</label>
                                <input type="text" name="first_name" required>
                                <div class="error-message" id="first_name_error"></div>
                            </div>
                            <div>
                                <label class="mb-2">Last Name</label>
                                <input type="text" name="last_name" required>
                                <div class="error-message" id="last_name_error"></div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="mb-2">Phone</label>
                            <input type="text" name="phone" required>
                            <div class="error-message" id="phone_error"></div>
                        </div>
                        <div class="mt-2">
                            <label class="mb-2">Email Address</label>
                            <input type="email" name="email" required>
                            <div class="error-message" id="email_error"></div>
                        </div>
                        <div class="mt-2">
                            <label class="mb-2">Country/ Region</label>
                            <select name="country" class="form-control" required>
                                <option value="" disabled selected>Select Country</option>
                                <option value="UAE">United Arab Emirates (UAE)</option>
                            </select>
                            <div class="error-message" id="country_error"></div>
                        </div>
                        <div class="mt-2">
                            <label class="mb-2">State</label>
                            <select name="state" class="form-control" required>
                                <option value="" disabled selected>Select State</option>
                                <option value="Abu Dhabi">Abu Dhabi</option>
                                <option value="Dubai">Dubai</option>
                                <option value="Sharjah">Sharjah</option>
                                <option value="Ajman">Ajman</option>
                                <option value="Umm Al Quwain">Umm Al Quwain</option>
                                <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                                <option value="Fujairah">Fujairah</option>
                            </select>
                            <div class="error-message" id="state_error"></div>
                        </div>  
                    </div>
                <div class="col-lg-6 mt-5">
                    <h2 class="mt-4"></h2>
                    <div class="">
                        <div class="mt-2">
                            <label class="mb-2">Town/city</label>
                            <input type="text" name="city" required>
                            <div class="error-message" id="city_error"></div>
                        </div>  
                        <div class="mt-2">
                            <label class="mb-2">Street address</label>
                            <input class="mb-2" type="text" name="address_line_1" required>
                            <div class="error-message" id="address_line_1_error"></div>
                            <input type="text" name="address_line_2">
                        </div>
                        <div class="mt-2">
                            <label class="mb-2">Zipcode</label>
                            <input type="text" name="zipcode" required>
                            <div class="error-message" id="zipcode_error"></div>
                        </div>
                    </div>  
                </div>
                <div class="col-12 mt-4 web-tabel">
                    <h2>Your Order</h2>
                    @php
                        $vat = $total * 0.05;
                        $grandTotal = $total + $vat;
                    @endphp
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th style="padding: 20px 20px !important;">Product</th>
                                <th style="padding: 20px 20px !important;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    <td style="padding: 15px 20px !important;">
                                        <span class="text-muted">{{ $item['name'] }}</span>
                                        <strong>× {{ $item['quantity'] }}</strong>
                                    </td>
                                    <td style="padding: 15px 20px !important;" class="text-success"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">{{ $item['subtotal'] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td style="padding: 15px 20px !important;" class="fw-bold">Subtotal</td>
                                <td style="padding: 15px 20px !important;" class="fw-bold text-success"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">{{ $total }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 20px !important;" class="fw-bold">VAT (5%)</td>
                                <td style="padding: 15px 20px !important;" class="fw-bold text-success"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">{{ number_format($vat, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 20px !important;" class="fw-bold">Total</td>
                                <td style="padding: 15px 20px !important;" class="fw-bold text-success"><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">{{ number_format($grandTotal, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-end">
                        <button type="submit" class="mt-3">Place Order</button>
                    </div>
                </form>
            </div>
            <div class="col-12 mt-4 mob-tabel">
                <h2>Your Order</h2>
                <div class="product-details">
                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between">
                            <p>{{ $item['name'] }} × {{ $item['quantity'] }}</p>
                            <p><span><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="10" height="10" class="img-fluid mb-1 me-1">{{ $item['subtotal'] }}</span></p>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-3">
                        <h3>Subtotal</h3>
                        <h3><span><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">{{ $total }}</span></h3>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <h4>Total</h4>
                        <h4><span><img src="{{ asset('web/asset/dirham.png') }}" alt="AED" width="17" height="17" class="img-fluid mb-1 me-1">{{ $total }}</span></h4>
                    </div>
                </div>
                    <button class="mt-3 text-end" onclick="validateAndSubmit()" type="button">Place Order</button>
            </div>
        </div>
        </div>
    </section>
    <!-- Order Success Modal -->
    <div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-success text-white border-0">
                <h5 class="modal-title" id="orderSuccessModalLabel">Order Placed Successfully!</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body" id="orderModalBody">
                    <!-- Filled by JavaScript -->
                </div>
                <div class="modal-footer border-0">
                    <a href="/" class="btn" style="background-color:#F7941D; color:rgb(255, 255, 255);"><strong>Back to Home</strong></a>
                </div>
            </div>
        </div>
    </div>

<style>
.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: none;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('mainCheckoutForm');
        
        // Add event listeners to all required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            field.addEventListener('input', function() {
                validateField(this);
            });
            field.addEventListener('blur', function() {
                validateField(this);
            });
        });
        
        // Add submit event listener
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    });

    function validateField(field) {
        const errorElement = document.getElementById(`${field.name}_error`);
        
        if (!field.value.trim()) {
            showError(errorElement, 'This field is required');
            return false;
        }
        
        // Special validation for email
        if (field.type === 'email' && !isValidEmail(field.value)) {
            showError(errorElement, 'Please enter a valid email address');
            return false;
        }
        
        // Special validation for phone
        if (field.name === 'phone' && !isValidPhone(field.value)) {
            showError(errorElement, 'Please enter a valid phone number');
            return false;
        }
        
        // Special validation for zipcode
        if (field.name === 'zipcode' && !isValidZipcode(field.value)) {
            showError(errorElement, 'Please enter a valid zipcode');
            return false;
        }
        
        hideError(errorElement);
        return true;
    }

    function validateForm() {
    let isValid = true;
    const form = document.getElementById('mainCheckoutForm');
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            // If this is the first invalid field, scroll to it
            if (isValid) {
                field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                field.focus();
            }
            isValid = false;
        }
    });
    
    return isValid;
}

function validateAndSubmit() {
    const form = document.getElementById('mainCheckoutForm');
    const formData = new FormData(form);

    fetch("{{ route('place.order') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showOrderPopup(data.order);
        } else {
            // Handle validation errors
            alert("Order failed to place.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

    function showError(element, message) {
        if (element) {
            element.textContent = message;
            element.style.display = 'block';
            element.previousElementSibling.classList.add('is-invalid');
        }
    }

    function hideError(element) {
        if (element) {
            element.textContent = '';
            element.style.display = 'none';
            element.previousElementSibling.classList.remove('is-invalid');
        }
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function isValidPhone(phone) {
        // Basic phone validation - adjust as needed
        const re = /^[0-9]{10,15}$/;
        return re.test(phone);
    }

    function isValidZipcode(zipcode) {
        // Basic zipcode validation - adjust as needed
        const re = /^[0-9]{4,10}$/;
        return re.test(zipcode);
    }
</script>
<script>
$(document).ready(function() {
    $('#mainCheckoutForm').submit(function(e) {
        e.preventDefault();
        
        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: formData,
            success: function(response) {
                if (response.success) {
                    showOrderPopup(response.order);
                    $('#mainCheckoutForm')[0].reset();
                }
            },
        });
    });
});

function showOrderPopup(order) {
    const modalBody = `
        <p><strong>Order ID:</strong> ${order.order_id}</p>
        <p><strong>Date:</strong> ${order.order_date}</p>
        <p><strong>Total Items:</strong> ${order.total_items}</p>
        <p><strong>Tax:</strong>AED ${order.tax_amount}</p>
        <p><strong>Total Amount:</strong> AED ${order.total_amount}</p>
        <p><strong>Order Status:</strong>${order.order_status}</p>
    `;
    document.getElementById('orderModalBody').innerHTML = modalBody;

    const orderModal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
    orderModal.show();
}
</script>

@endsection
        