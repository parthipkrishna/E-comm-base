@extends('layouts.dashboard')
@section('list-company-info')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Company Info</a></li>
                        <li class="breadcrumb-item active">Company Info</li>
                    </ol>
                </div>
                <h4 class="page-title">Company Info</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <form class="needs-validation" id="CompanyInfoForm" method="POST" action="{{ isset($companyinfo) ? route('admin.companyinfo.update/{id}', $companyinfo->id) : route('admin.companyinfo.store') }}"enctype="multipart/form-data" validate>
                    @csrf
                    <div class="row">
                        <!-- Left column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="company_intro" class="form-label">Company Introduction</label>
                                <textarea class="form-control" name="company_intro" id="company_intro" rows="3">{{ old('company_intro', $companyinfo->company_intro ?? '') }}</textarea>
                                @error('company_intro')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="intro_image" class="form-label">Intro Image</label>
                                <input type="file" class="form-control" name="intro_image" id="intro_image">
                                @if(isset($companyinfo) && $companyinfo->intro_image)
                                    <img src="{{ asset('storage/' . $companyinfo->intro_image) }}" alt="Intro Image" class="img-fluid mt-2" width="100">
                                @endif
                                @error('intro_image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $companyinfo->phone ?? '') }}">
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $companyinfo->email ?? '') }}">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Right column -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="2">{{ old('address', $companyinfo->address ?? '') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mission" class="form-label">Mission</label>
                                <textarea class="form-control" name="mission" id="mission" rows="2">{{ old('mission', $companyinfo->mission ?? '') }}</textarea>
                                @error('mission')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="vision" class="form-label">Vision</label>
                                <textarea class="form-control" name="vision" id="vision" rows="2">{{ old('vision', $companyinfo->vision ?? '') }}</textarea>
                                @error('vision')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Full-width section -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="about_short_desc" class="form-label">About (Short Description)</label>
                                <textarea class="form-control" name="about_short_desc" id="about_short_desc" rows="2">{{ old('about_short_desc', $companyinfo->about_short_desc ?? '') }}</textarea>
                                @error('about_short_desc')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="about_desc" class="form-label">About (Full Description)</label>
                                <textarea class="form-control" name="about_desc" id="about_desc" rows="4">{{ old('about_desc', $companyinfo->about_desc ?? '') }}</textarea>
                                @error('about_desc')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-start">
                        <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($companyinfo) ? 'Update' : 'Save' }}
                            </button>
                    </div>
                </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
