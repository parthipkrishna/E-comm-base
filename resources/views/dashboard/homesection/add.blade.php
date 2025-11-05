@extends('layouts.dashboard')
@section('home-section-add')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home Sections</a></li>
                        <li class="breadcrumb-item active">Add Section</li>
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
                    <h4 class="header-title mb-3">Add Home Section</h4>
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
                        <form class="needs-validation" id="homeSectionForm" method="POST" action="{{ route('admin.homesection.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">Title</label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Enter Title">
                                        @error('title')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="short_desc">Short Description</label>
                                        <input type="text" name="short_desc" value="{{ old('short_desc') }}" class="form-control" id="short_desc" placeholder="Enter Short Description">
                                        @error('short_desc')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="bg_image">Background Image</label>
                                        <input type="file" name="bg_image" class="form-control" id="bg_image">
                                        @error('bg_image')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="mockup_image">Mockup Image</label>
                                        <input type="file" name="mockup_image" class="form-control" id="mockup_image">
                                        @error('mockup_image')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 form-group">
                                            <label for="type">Section Type</label>
                                            <select name="type" class="form-select">
                                                <option value="" disabled selected>Select</option>
                                                <option value="approach">Approach</option>
                                                <option value="intro">Intro</option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status: <span style="color:red">*</span></label><br>
                                        <input type="checkbox" name="status" id="statusSwitch" value="1" checked data-switch="success" onchange="this.value = this.checked ? 1 : 0;" />
                                        <label for="statusSwitch" data-on-label="" data-off-label=""></label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-start">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


@endsection
