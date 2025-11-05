@extends('layouts.dashboard')
@section('add-user')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Categories</a></li>
                        <li class="breadcrumb-item active">Add Categories</li>
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
                    <h4 class="header-title mb-3">Add Categories</h4>
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
                    <form class="needs-validation" id="categoryForm" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" validate>
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Category Name -->
                                    <div class="mb-3">
                                        <label class="form-label" for="categoryName">Category Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="categoryName" placeholder="Category Name">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Parent Category -->
                                    {{-- <div class="mb-3">
                                        <label class="form-label" for="parentCategory">Parent Category</label>
                                        <select class="form-select" name="parent_id" id="parentCategory">
                                            <option value="">-- None --</option>
                                            @foreach ($categories as $parent)
                                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label class="form-label" for="status">Status: <span style="color:red">*</span></label><br/>
                                        <input type="checkbox" name="status" id="switch_status" value="1" checked data-switch="success" onchange="this.value = this.checked ? 1 : 0;" />
                                        <label for="switch_status" data-on-label="" data-off-label=""></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label" for="categoryDescription">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="categoryDescription" placeholder="Enter description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Upload Image -->
                                    <div class="mb-3">
                                        <label class="form-label" for="categoryImage">Upload Image</label>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="categoryImage">
                                        @error('image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Form Buttons -->
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
