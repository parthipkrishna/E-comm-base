@extends('layouts.dashboard')
@section('list-faq')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">FAQs</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
                <h4 class="page-title">FAQs</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a href="{{ route('admin.home-banner.add') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add </a>
                        </div>
                        <div class="col-sm-7">
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="banner-datatable">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>CTA Text</th>
                                <th>CTA URL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>
                                        @if ($banner->image)
                                            <img src="{{ asset('storage/' . $banner->image) }}" alt="banner image" height="70" width="100" class="rounded">
                                        @else
                                            <span class="text-danger small">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $banner->title ?? '-' }}</td>
                                    <td>{{ $banner->sub_title ?? '-' }}</td>
                                    <td>{{ $banner->cta_text ?? '-' }}</td>
                                    <td>
                                        @if ($banner->cta_url)
                                            <a href="{{ $banner->cta_url }}" target="_blank">View Link</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#edit-home-banner-modal{{ $banner->id }}">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#delete-home-banner-modal{{ $banner->id }}">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            <!-- Edit Modal-->
                            <div class="modal fade" id="edit-home-banner-modal{{ $banner->id }}" tabindex="-1" role="dialog" aria-labelledby="editHomeBannerLabel{{ $banner->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editHomeBannerLabel{{ $banner->id }}">Edit Home Banner</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.homebanner.update/{id}', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <!-- Left Column -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="image{{ $banner->id }}" class="form-label">Banner Image</label>
                                                            <input type="file" name="image" class="form-control" id="image{{ $banner->id }}">
                                                            @if($banner->image)
                                                                <div class="mt-2">
                                                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Current Banner" height="80%" width="80%" class="rounded">
                                                                    <p class="text-muted small mt-1">Current Image</p>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="title{{ $banner->id }}" class="form-label">Title</label>
                                                            <input type="text" name="title" class="form-control" id="title{{ $banner->id }}" value="{{ $banner->title ?? '' }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="sub_title{{ $banner->id }}" class="form-label">Sub Title</label>
                                                            <input type="text" name="sub_title" class="form-control" id="sub_title{{ $banner->id }}" value="{{ $banner->sub_title ?? '' }}">
                                                        </div>
                                                    </div>

                                                    <!-- Right Column -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="cta_text{{ $banner->id }}" class="form-label">CTA Text</label>
                                                            <input type="text" name="cta_text" class="form-control" id="cta_text{{ $banner->id }}" value="{{ $banner->cta_text ?? '' }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="cta_url{{ $banner->id }}" class="form-label">CTA URL</label>
                                                            <input type="url" name="cta_url" class="form-control" id="cta_url{{ $banner->id }}" value="{{ $banner->cta_url ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-start gap-2">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <div id="delete-home-banner-modal{{ $banner->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-body p-4">
                                            <div class="text-center">
                                                <i class="ri-information-line h1 text-info"></i>
                                                <h4 class="mt-2">Heads up!</h4>
                                                <p class="mt-3">Are you sure you want to delete this banner?</p>
                                                <form action="{{ route('admin.homebanner.delete/{id}', $banner->id) }}" method="POST">
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
@endsection