@extends('layouts.dashboard')
@section('add-user')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">Add Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Add Product</h4>
                    <div class="row justify-content-center">
                         {{-- Display general messages --}}
                         @if ($message = session()->get('message'))
                            <div class="alert alert-success text-center w-75">
                                <h6 class="text-center fw-bold">{{ $message }}...</h6>
                            </div>
                        @endif
                        {{-- Display validation error messages --}}
                        @if ($errors->any())
                            <div class="alert alert-danger text-center w-75">
                                @foreach ($errors->all() as $error)
                                    <h6 class="text-center fw-bold">{{ $error }}</h6>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                        <form class="needs-validation" id="productForm" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" validate>
                            @csrf
                            <div class="row">
                                <!-- LEFT COLUMN -->
                                <div class="col-lg-6">
                                    <!-- Product Name -->
                                    <div class="mb-3">
                                        <label class="form-label" for="productName">Product Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="productName" placeholder="Enter product name" required>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Categories -->
                                    <div class="mb-3">
                                        <label class="form-label" for="category_ids">Categories</label>
                                        <select class="form-select select2" name="category_ids[]" id="category_ids" multiple required data-placeholder="Select categories">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ collect(old('category_ids'))->contains($category->id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_ids')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Unit Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="unit_price">Unit Price</label>
                                        <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price') }}" class="form-control" id="unit_price" placeholder="0.00" required>
                                    </div>

                                    <!-- Selling Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="selling_price">Selling Price</label>
                                        <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price') }}" class="form-control" id="selling_price" placeholder="0.00" required>
                                    </div>

                                    <!-- Wholesale Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="wholesale_price">Wholesale Price</label>
                                        <input type="number" step="0.01" name="wholesale_price" value="{{ old('wholesale_price') }}" class="form-control" id="wholesale_price" placeholder="0.00">
                                    </div>

                                    <!-- Offer Price -->
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_price">Offer Price</label>
                                        <input type="number" step="0.01" name="offer_price" value="{{ old('offer_price') }}" class="form-control" id="offer_price" placeholder="0.00">
                                    </div>

                                    <!-- Stock Quantity -->
                                    <div class="mb-3">
                                        <label class="form-label" for="stock_quantity">Stock Quantity</label>
                                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity') }}" class="form-control" id="stock_quantity" placeholder="Enter quantity" required>
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label class="form-label">Status</label><br/>
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" value="1" id="statusSwitch" checked data-switch="success" />
                                        <label for="statusSwitch" data-on-label="On" data-off-label="Off"></label>
                                    </div>

                                    <!-- In Stock -->
                                    <div class="mb-3">
                                        <label class="form-label">In Stock</label><br/>
                                        <input type="hidden" name="in_stock" value="0">
                                        <input type="checkbox" name="in_stock" value="1" id="inStockSwitch" checked data-switch="success" />
                                        <label for="inStockSwitch" data-on-label="Yes" data-off-label="No"></label>
                                    </div>

                                    <!-- Feature Tag -->
                                    <div class="mb-3">
                                        <label class="form-label">Feature Tag</label><br/>
                                        <input type="hidden" name="feature_tag" value="0">
                                        <input type="checkbox" name="feature_tag" value="1" id="featureTagSwitch" data-switch="success" />
                                        <label for="featureTagSwitch" data-on-label="Yes" data-off-label="No"></label>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="mb-3">
                                        <label class="form-label" for="productImage">Upload Image</label>
                                        <input type="file" name="image" class="form-control" id="productImage">
                                    </div>
                                </div>

                                <!-- RIGHT COLUMN -->
                                <div class="col-lg-6">
                                    <!-- Full Description -->
                                    <div class="mb-3">
                                        <label class="form-label" for="description">Full Description</label>
                                        <div id="description-editor" style="height: 200px;">{!! old('description') !!}</div>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror d-none" id="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Short Description -->
                                    <div class="mb-3">
                                        <label class="form-label" for="short_desc">Short Description</label>
                                        <div id="short-desc-editor" style="height: 150px;">{!! old('short_desc') !!}</div>
                                        <textarea name="short_desc" class="form-control d-none" id="short_desc">{{ old('short_desc') }}</textarea>
                                    </div>

                                    <!-- Features Description -->
                                    <div class="mb-3">
                                        <label class="form-label" for="features_desc">Features</label>
                                        <div id="features-desc-editor" style="height: 150px;">{!! old('features_desc') !!}</div>
                                        <input type="hidden" name="features_desc" id="features_desc" value="{{ old('features_desc') }}">
                                        <div class="form-text"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="text-start">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-primary">Create Product</button>
                            </div>
                        </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select categories"
            });
        });
    </script>
    <script>
    var quill = new Quill('#bubble-editor', {
        theme: 'bubble'
    });

    document.getElementById('productForm').onsubmit = function() {
        document.getElementById('bubble_content').value = quill.root.innerHTML;
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill for full description
        const descriptionEditor = new Quill('#description-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            },
            placeholder: 'Enter full description'
        });
        
        // Initialize Quill for short description
        const shortDescEditor = new Quill('#short-desc-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link'],
                    ['clean']
                ]
            },
            placeholder: 'Short description'
        });
        
        // Initialize Quill for features description
        const featuresDescEditor = new Quill('#features-desc-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic'],
                    [{ 'list': 'bullet' }],
                    ['clean']
                ]
            },
            placeholder: 'Enter features'
        });
        
        // Get the hidden input/textarea elements
        const descriptionTextarea = document.querySelector('#description');
        const shortDescTextarea = document.querySelector('#short_desc');
        const featuresDescInput = document.querySelector('#features_desc');
        
        // Update hidden fields with HTML content when editors change
        descriptionEditor.on('text-change', function() {
            descriptionTextarea.value = descriptionEditor.root.innerHTML;
        });
        
        shortDescEditor.on('text-change', function() {
            shortDescTextarea.value = shortDescEditor.root.innerHTML;
        });
        
        featuresDescEditor.on('text-change', function() {
            featuresDescInput.value = featuresDescEditor.root.innerHTML;
        });
        
        // Set initial content if there's old input
        if (descriptionTextarea.value) {
            descriptionEditor.root.innerHTML = descriptionTextarea.value;
        }
        
        if (shortDescTextarea.value) {
            shortDescEditor.root.innerHTML = shortDescTextarea.value;
        }
        
        if (featuresDescInput.value) {
            featuresDescEditor.root.innerHTML = featuresDescInput.value;
        }
    });
</script>

@endsection