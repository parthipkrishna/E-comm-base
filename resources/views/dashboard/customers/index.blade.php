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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
                <h4 class="page-title">Customers</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-7">
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="customer-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th>Users</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_main as $user)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{ asset('dashboard/assets/images/customer.jpg') }}" class="me-2 rounded-circle" alt="User Image">
                                        </td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td><span class="fw-semibold">{{ $user['phone_number'] }}</span></td>
                                        <td>{{ $user['user_role'] }}</td>
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
@endsection
