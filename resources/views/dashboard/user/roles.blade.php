@extends('layouts.dashboard')
@section('roles')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">EStore</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
                <h4 class="page-title">Roles</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <div class="row align-items-center mb-3">
                        <div class="col-md-6">
                            <h4 class="header-title mb-0">Roles</h4>
                        </div>
                        <div class="col-md-6 text-md-end text-start">
                            <button type="button" class="btn btn-soft-primary">+ Add Roles</button>
                        </div>
                    </div>
                    
                    
                    
                    <div class="tab-content">
                        <div class="tab-pane show active" id="striped-rows-preview">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>AC336 508 2157</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>SB646 473 2057</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>DL281 308 0793</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>CA269 714 6825</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->   
    </div><!-- end row--> 
@endsection