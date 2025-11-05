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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Stock Report</a></li>
                        <li class="breadcrumb-item active">Stock Reports</li>
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
                <div class="row">   
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="page-title m-0">Stock Report</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="{{ route('products.export.stock') }}" class="btn btn-light me-2">
                            <i class="mdi mdi-square-edit-outline"></i> Export
                        </a>
                        <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#bs-importCertificate-modal">
                            <i class="mdi mdi-square-edit-outline"></i> Import
                        </a>
                    </div>
                </div>

                </div>
                <div class="row mb-2">
                    <div class="col-md-2">
                        <form method="GET" action="{{ route('admin.stock.show') }}">
                            <select name="stock_filter" class="form-select" onchange="this.form.submit()">
                                <option value="">All</option>
                                <option value="in_stock" {{ request('stock_filter') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="out_of_stock" {{ request('stock_filter') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                        </form>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="stock-datatable">
                            <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>InStock</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product_unique_identifier }}</td>
                                            <td>{{ $product->name }}</td>
                                            <!-- Price (showing selling price or unit price) -->
                                            <td>
                                                <strong><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;">{{ number_format($product->unit_price, 2) }}</strong>
                                            </td>
                                            <td>
                                                <div>
                                                    <input type="checkbox"
                                                        id="inStockSwitch{{ $product->id }}"
                                                        data-id="{{ $product->id }}"
                                                        class="product-instock-toggle"
                                                        {{ $product->in_stock == 1 ? 'checked' : '' }}
                                                        data-switch="success" />
                                                    <label for="inStockSwitch{{ $product->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block" style="cursor: pointer;"></label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $product->stock_quantity }}
                                            </td>
                                        </tr>
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
                            <p>Download the <a href="{{ asset('dashboard/assets/stock_import.xlsx') }}" download>Sample Excel File</a> for Stock Import</p>
                            <p>Note: Please make sure the Product ID in the Excel file exactly matches the Product ID in Stock Report </p>
                        </div>

                        <form action="{{ route('products.import.stock') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Upload Excel File</label>
                                <input type="file" name="stock_file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('.product-instock-toggle').on('change', function () {
                        var productId = $(this).data('id');
                        var inStock = $(this).is(':checked') ? 1 : 0;

                        $.ajax({
                            url: "{{ route('admin.stock.toggleInStockAjax') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                product_id: productId,
                                in_stock: inStock
                            },
                            success: function (response) {
                                console.log(response.message);
                            },
                            error: function () {
                                alert('Error updating in-stock status!');
                            }
                        });
                    });
                });
            </script>
@endsection