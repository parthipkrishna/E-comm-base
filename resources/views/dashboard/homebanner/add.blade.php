@extends('layouts.dashboard')
@section('add-banner')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home Banner</a></li>
                        <li class="breadcrumb-item active">Banner</li>
                    </ol>
                </div>
                <h4 class="page-title">Home Banner</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <form class="needs-validation" id="HomeBannerForm" method="POST" action="{{route('admin.homebanner.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Banner Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                                @error('title')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="sub_title" class="form-label">Sub Title</label>
                                <input type="text" class="form-control" name="sub_title" id="sub_title">
                                @error('sub_title')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Banner Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @error('image')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="cta_text" class="form-label">CTA Text</label>
                                <input type="text" class="form-control" name="cta_text" id="cta_text">
                                @error('cta_text')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cta_url" class="form-label">CTA URL</label>
                                <input type="url" class="form-control" name="cta_url" id="cta_url">
                                @error('cta_url')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-start">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
