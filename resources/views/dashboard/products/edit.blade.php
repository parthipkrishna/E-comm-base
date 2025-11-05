@extends('layouts.dashboard')
@section('edit-product')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">Edit Products</li>
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
                    <h4 class="header-title mb-3">Edit Product</h4>
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
                        <form action="{{ route('product.update/{id}', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="name{{ $product->id }}" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="name{{ $product->id }}" name="name" value="{{ $product->name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="category_ids">Category</label>
                                        <select class="form-select select2" name="category_ids[]" id="category_ids" multiple required data-placeholder="Select categories">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" 
                                                @if(collect(old('category_ids', is_string($product->category_ids) ? json_decode($product->category_ids, true) : $product->category_ids))->contains($category->id))
                                                        selected 
                                                    @endif
                                                >
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                            @error('category_ids')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="name{{ $product->id }}" class="form-label">Unit Price</label>
                                        <input type="text" class="form-control" id="unit_price{{ $product->id }}" name="unit_price" value="{{ $product->unit_price }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description{{ $product->id }}" class="form-label">Selling Price</label>
                                        <textarea class="form-control" id="selling_price{{ $product->id }}" name="selling_price">{{ $product->selling_price }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description{{ $product->id }}" class="form-label">Wholesale price</label>
                                        <textarea class="form-control" id="wholesale_price{{ $product->id }}" name="wholesale_price">{{ $product->wholesale_price }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image_current" class="form-label">Current Image</label><br>
                                        @if ($product->image)
                                            <img src="{{ env('STORAGE_URL') . '/' . $product->image }}" class="img-fluid " style="width: 50%;">
                                        @else
                                            <span class="small text-danger">No Image</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Upload New Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description{{ $product->id }}" class="form-label">Stock quantity</label>
                                        <textarea class="form-control" id="stock_quantity{{ $product->id }}" name="stock_quantity">{{ $product->stock_quantity }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">In Stock</label><br/>
                                        <input type="hidden" name="in_stock" value="0"> {{-- fallback if not checked --}}
                                        <input type="checkbox" name="in_stock" value="1" id="inStockSwitch" {{ $product->in_stock ? 'checked' : '' }} data-switch="success" />
                                        <label for="inStockSwitch" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Feature Tag</label><br/>
                                        <input type="hidden" name="feature_tag" value="0"> {{-- fallback if unchecked --}}
                                        <input type="checkbox" name="feature_tag" value="1" id="featureTagSwitch" {{ $product->feature_tag ? 'checked' : '' }} data-switch="success" />
                                        <label for="featureTagSwitch" data-on-label="Yes" data-off-label="No"></label>
                                    </div> 
                                </div>
                                <!-- Right Column -->
                                <div class="col-lg-6">
                                    <!-- Description with Quill Editor -->
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <div id="description-editor-{{ $product->id }}" style="height: 200px;">{!! $product->description !!}</div>
                                        <textarea class="form-control d-none" id="description{{ $product->id }}" name="description">{{ $product->description }}</textarea>
                                    </div>

                                    <!-- Short Description with Quill Editor -->
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <div id="short-desc-editor-{{ $product->id }}" style="height: 150px;">{!! $product->short_desc !!}</div>
                                        <textarea class="form-control d-none" id="short_desc{{ $product->id }}" name="short_desc">{{ $product->short_desc }}</textarea>
                                    </div>
                                    

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label><br>
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" id="switch-status{{ $product->id }}" value="1" {{ $product->status ? 'checked' : '' }} data-switch="success" />
                                        <label for="switch-status{{ $product->id }}" data-on-label="" data-off-label=""></label>
                                    </div>
                                    <!-- Features Description with Quill Editor -->
                                    <div class="mb-3">
                                        <label class="form-label">Features Description</label>
                                        <div id="features-desc-editor-{{ $product->id }}" style="height: 150px;">{!! $product->features_desc !!}</div>
                                        <input type="hidden" id="features_desc{{ $product->id }}" name="features_desc" value="{{ $product->features_desc }}">
                                    </div>
                                    
                                    </div>
                                    </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize editors for each product (in case of multiple on page)
            initializeQuillEditors('{{ $product->id }}');
        });

        function initializeQuillEditors(productId) {
            // Description Editor
            const descEditor = new Quill(`#description-editor-${productId}`, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean']
                    ]
                }
            });
            
            // Short Description Editor
            const shortDescEditor = new Quill(`#short-desc-editor-${productId}`, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link'],
                        ['clean']
                    ]
                }
            });
            
            // Features Editor
            const featuresEditor = new Quill(`#features-desc-editor-${productId}`, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic'],
                        [{ 'list': 'bullet' }],
                        ['clean']
                    ]
                }
            });
            
            // Get hidden form fields
            const descTextarea = document.querySelector(`#description${productId}`);
            const shortDescTextarea = document.querySelector(`#short_desc${productId}`);
            const featuresInput = document.querySelector(`#features_desc${productId}`);
            
            // Set initial content
            if (descTextarea.value) {
                descEditor.root.innerHTML = descTextarea.value;
            }
            if (shortDescTextarea.value) {
                shortDescEditor.root.innerHTML = shortDescTextarea.value;
            }
            if (featuresInput.value) {
                featuresEditor.root.innerHTML = featuresInput.value;
            }
            
            // Update hidden fields on editor change
            descEditor.on('text-change', function() {
                descTextarea.value = descEditor.root.innerHTML;
            });
            
            shortDescEditor.on('text-change', function() {
                shortDescTextarea.value = shortDescEditor.root.innerHTML;
            });
            
            featuresEditor.on('text-change', function() {
                featuresInput.value = featuresEditor.root.innerHTML;
            });
        }
        </script>
@endsection