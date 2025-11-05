@extends('layouts.dashboard')
@section('list-user')

        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="bouncing-loader">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
                <h4 class="page-title">Products</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('product.add') }}" class="btn btn-danger mb-2">
                            <i class="mdi mdi-plus-circle me-2"></i> Add
                        </a>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-start">
                        <a href="{{ route('products.export') }}" class="btn btn-light mb-2 me-2">
                            <i class="mdi mdi-square-edit-outline"></i> Export
                        </a>
                        <a href="javascript:void(0);" class="btn btn-light mb-2" data-bs-toggle="modal" data-bs-target="#bs-importCertificate-modal">
                            <i class="mdi mdi-square-edit-outline"></i> Import
                        </a>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="product-datatable">
                            <thead class="table-dark">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Categories</th>
                                        <th>Short description</th>
                                        <th>Added Date</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <!-- Image -->
                                            <td class="table-user">
                                                @if ($product->image)
                                                    <img src="{{ env('STORAGE_URL') . '/' . $product->image }}" class="me-2 rounded-circle">
                                                @else
                                                    <span class="small text-danger">No Image</span>
                                                @endif
                                            </td>

                                            <!-- Name -->
                                            <td>{{ $product->name }}</td>

                                            <!-- Category Names (assuming $product->category_ids is JSON and categories available) -->
                                            <td>
                                                @php
                                                    // Check if category_ids is a string (JSON format)
                                                    $categoryIds = is_string($product->category_ids) 
                                                        ? json_decode($product->category_ids, true) 
                                                        : $product->category_ids; // It's already an array
                                                @endphp
                                                @php
                                                    // Now, safely get category names
                                                    $categoryNames = \App\Models\Category::whereIn('id', $categoryIds)->pluck('name')->toArray();
                                                @endphp
                                                {{ $categoryNames ? implode(', ', $categoryNames) : '-' }}
                                            </td>
                                            <td class="text-start" style="white-space: normal; word-wrap: break-word; max-width: 200px;">
                                                {!! $product->short_desc ?? 'No description available' !!}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($product->created_at)->toDateString() }}</td>
                                            <!-- Price (showing selling price or unit price) -->
                                            <td>
                                                <strong><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;">{{ number_format($product->selling_price ?: $product->unit_price, 2) }}</strong>
                                            </td>
                                            <td>
                                                {{ $product->stock_quantity }}
                                            </td>
                                            <!-- Status -->
                                            <td>
                                                <div>
                                                    <input type="checkbox" 
                                                        id="switch{{ $product->id }}" 
                                                        data-id="{{ $product->id }}" 
                                                        class="status-toggle" 
                                                        {{ $product->status == 1 ? 'checked' : '' }}  
                                                        data-switch="success"/>
                                                    <label for="switch{{ $product->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block" style="cursor: pointer;"></label>
                                                </div>
                                            </td>
                                            <!-- Action -->
                                            <td>
                                                <!-- Edit Modal Trigger -->
                                                <a href="{{ route('admin.product.edit',$product->id) }}"  class="action-icon">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <!-- Delete Modal Trigger -->
                                                <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#delete-product-modal{{ $product->id }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal-->
                                        <div class="modal fade" id="edit-product-modal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal{{ $product->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="editCategoryLabel{{ $product->id }}">Edit Product</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
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
                                                                        <label for="description{{ $product->id }}" class="form-label">Description</label>
                                                                        <textarea class="form-control" id="description{{ $product->id }}" name="description">{{ $product->description }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="description{{ $product->id }}" class="form-label">short Description</label>
                                                                        <textarea class="form-control" id="description{{ $product->id }}" name="short_desc">{{ $product->short_desc }}</textarea>
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
                                                                </div>

                                                                <!-- Right Column -->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="image_current" class="form-label">Current Image</label><br>
                                                                        @if ($product->image)
                                                                            <img src="{{ env('STORAGE_URL') . '/' . $product->image }}" class="img-fluid avatar-xl">
                                                                        @else
                                                                            <span class="small text-danger">No Image</span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="status" class="form-label">Status</label><br>
                                                                        <input type="hidden" name="status" value="0">
                                                                        <input type="checkbox" name="status" id="switch-status{{ $product->id }}" value="1" {{ $product->status ? 'checked' : '' }} data-switch="success" />
                                                                        <label for="switch-status{{ $product->id }}" data-on-label="" data-off-label=""></label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="image" class="form-label">Upload New Image</label>
                                                                        <input type="file" name="image" class="form-control">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="name{{ $product->id }}" class="form-label">Features description</label>
                                                                        <input type="text" class="form-control" id="features_desc{{ $product->id }}" name="features_desc" value="{{ $product->features_desc }}">
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
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="category_ids">Categories</label>
                                                                        <select class="form-select select2" name="category_ids[]" id="category_ids" multiple required data-placeholder="Select categories" required>
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
                                                                        </div>
                                                                    </div>

                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        <div id="delete-product-modal{{ $product->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="ri-information-line h1 text-info"></i>
                                                            <h4 class="mt-2">Heads up!</h4>
                                                            <p class="mt-3">Do you want to delete this Product?</p>
                                                            <form action="{{ route('product.delete/{id}', $product->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger my-2">Delete</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <div class="modal fade" id="bs-importCertificate-modal" tabindex="-1" role="dialog" aria-labelledby="importMarkListLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="importMarkListLabel">Import</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif                                

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <p>Download the <a href="{{ asset('dashboard/assets/products_import.xlsx') }}" download>Sample Excel File</a> for Import Products</p>
                            <p>Note: Please make sure the Category name in the Excel file exactly matches the Category name in Categories </p>
                        </div>

                        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Upload Excel File</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('.status-toggle').on('change', function () {
                        var productId = $(this).data('id');
                        var status = $(this).is(':checked') ? 1 : 0;

                        $.ajax({
                            url: "{{ route('admin.product.toggleStatusAjax') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                product_id: productId,
                                status: status
                            },
                            success: function (response) {
                                console.log(response.message);
                            },
                            error: function () {
                                alert('Something went wrong! Please try again.');
                            }
                        });
                    });
                });
            </script>

@endsection