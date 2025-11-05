@extends('layouts.dashboard')
@section('analytics')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <div class="input-group">
                                <!-- <input type="text" class="form-control form-control-light"
                                    id="dash-daterange">
                                <span class="input-group-text bg-primary border-primary text-white">
                                    <i class="mdi mdi-calendar-range font-13"></i>
                                </span> -->
                            </div>
                            <a href="javascript: location.reload();" class="btn btn-primary ms-2" title="Refresh">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <!-- <a href="javascript: void(0);" class="btn btn-primary ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a> -->
                        </form>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-5 col-lg-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Customers
                                </h5>
                                <h3 class="mt-3 mb-3">{{ $customerCount }}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>
                                        {{ $customer_growth_percentage }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-cart-plus widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                                <h3 class="mt-3 mb-3">{{ $orderCount }}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>
                                        {{ $order_growth_percentage }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-currency-usd widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Revenue</h5>
                                <h3 class="mt-3 mb-3">AED{{ $total }}</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i>
                                        {{ $revenue_growth_percentage }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-sm-6">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-pulse widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Growth">Growth</h5>
                                <h3 class="mt-3 mb-3">+{{ $total_growth_percentage }}%</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i>
                                        {{ $monthly_growth_percentage }}%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- end col -->

            <div class="col-xl-7 col-lg-6">
                <div class="card card-h-100">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h4 class="header-title">Projections Vs Actuals</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div dir="ltr">
                            <div id="high-performing-product" class="apex-charts"
                                data-colors="#727cf5,#91a6bd40"></div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
        <div class="col-xl-12 col-lg-12">

            <div class="row">
                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-account-multiple widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Products
                            </h5>
                            <h3 class="mt-3 mb-3">{{ $productCount }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-nowrap">Total Products</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-cart-plus widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Categories</h5>
                            <h3 class="mt-3 mb-3">{{ $categoryCount }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-nowrap">Total Categories</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-cart-plus widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Customers</h5>
                            <h3 class="mt-3 mb-3">{{ $customerCount }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-nowrap">Active Customers</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-cart-plus widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Users</h5>
                            <h3 class="mt-3 mb-3">{{ $usersCount }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-nowrap">Total users</span>
                            </p>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Revenue</h4>
                </div>
                <div class="card-body pt-1">
                    <div class="chart-content-bg">
                        <div class="row text-center">
                            <div class="col-sm-6">
                                <p class="text-muted mb-0 mt-3">Current Week</p>
                                <h2 class="fw-normal mb-3">
                                    <small
                                        class="mdi mdi-checkbox-blank-circle text-primary align-middle me-1"></small>
                                    <span>AED {{ $this_week }}</span>
                                </h2>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-0 mt-3">Previous Week</p>
                                <h2 class="fw-normal mb-3">
                                    <small
                                        class="mdi mdi-checkbox-blank-circle text-success align-middle me-1"></small>
                                    <span>AED {{ $last_week }}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="dash-item-overlay d-none d-md-block" dir="ltr">
                        <h5>Today's Earning: AED {{ $today_earning }}</h5>
                        <p class="text-muted font-13 mb-3 mt-2">Etiam ultricies nisi vel augue.
                            Curabitur ullamcorper ultricies nisi. Nam eget dui.
                            Etiam rhoncus...</p>
                        <a href="{{ route('admin.order.show') }}" class="btn btn-outline-primary">View Orders
                            <i class="mdi mdi-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <div dir="ltr">
                        <div id="revenue-chart" class="apex-charts mt-3" data-colors="#727cf5,#0acf97">
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Top Selling Products</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                @foreach ($topSellingProducts as $product)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">{{ $product->name }}</h5>
                                        <span class="text-muted font-13">{{ \Carbon\Carbon::parse($product->latest_date)->format('d M Y') }}</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">AED {{ number_format($product->unit_price, 2) }}</h5>
                                        <span class="text-muted font-13">Price</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">{{ $product->total_quantity }}</h5>
                                        <span class="text-muted font-13">Quantity</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">AED {{ number_format($product->total_amount, 2) }}</h5>
                                        <span class="text-muted font-13">Amount</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="height: 30px;"></div>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
</div>
    
@endsection