@extends('layouts.dashboard')
@section('list-order')
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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
                <h4 class="page-title">Orders</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                    <!-- <div class="col-sm-5">
                            <a href="{{ route('admin.order.add') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add </a>
                        </div> -->
                        <div class="col-sm-7">
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="orders-datatable">
                        <thead class="table-dark">
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Date</th>
                                        <th>Payment Status</th>
                                        <th>Total</th>
                                        <th>Order Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                        <td>
                                            <a href="{{ route('admin.order.update/{id}', $order->id) }}" class="text-primary">
                                                #{{ $order->order_number }}
                                            </a>
                                        </td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if ($order->payment_status === 'Paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif ($order->payment_status === 'Unpaid')
                                                    <span class="badge bg-danger">Unpaid</span>
                                                @elseif ($order->payment_status === 'Payment Failed')
                                                    <span class="badge bg-warning text-dark">Failed</span>
                                                @else
                                                    <span class="badge bg-secondary">Awaiting</span>
                                                @endif
                                            </td>
                                            <td><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;">{{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge 
                                                @if($order->order_status === 'order placed') bg-info
                                                    @elseif($order->order_status === 'processing') bg-info
                                                    @elseif($order->order_status === 'shipped') bg-primary
                                                    @elseif($order->order_status === 'delivered') bg-success
                                                    @elseif($order->order_status === 'cancelled') bg-danger
                                                    @endif">
                                                    {{ ucfirst($order->order_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.order.update/{id}',$order->id) }}" class="action-icon">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#delete-order-modal{{ $order->id }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>                      
                                    <div id="delete-order-modal{{ $order->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-body p-4">
                                                    <div class="text-center">
                                                        <i class="ri-information-line h1 text-info"></i>
                                                        <h4 class="mt-2">Heads up!</h4>
                                                        <p class="mt-3">Do you want to delete this order <strong>#{{ $order->order_number }}</strong>?</p>
                                                        <form action="{{ route('admin.order.delete/{id}', $order->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger my-2">Delete</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection