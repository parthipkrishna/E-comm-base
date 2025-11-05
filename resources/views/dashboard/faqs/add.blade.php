@extends('layouts.dashboard')
@section('add-faq')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">FAQs</a></li>
                        <li class="breadcrumb-item active">Add FAQ</li>
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
                    <h4 class="header-title mb-3">Add FAQs</h4>
                    
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                        <form class="needs-validation" id="faqForm" method="POST" action="{{ route('admin.faq.store') }}" validate>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Question -->
                                        <div class="mb-3">
                                            <label class="form-label" for="faqQuestion">Question <span class="text-danger">*</span></label>
                                            <textarea name="question" class="form-control @error('question') is-invalid @enderror" id="faqQuestion" placeholder="Enter the FAQ question">{{ old('question') }}</textarea>
                                            @error('question')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Answer -->
                                        <div class="mb-3">
                                            <label class="form-label" for="faqAnswer">Answer <span class="text-danger">*</span></label>
                                            <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" id="faqAnswer" placeholder="Enter the FAQ answer" >{{ old('answer') }}</textarea>
                                            @error('answer')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label class="form-label" for="status">Status</label><br/>
                                            <input type="checkbox" name="status" id="switch_status" value="1" checked data-switch="success" onchange="this.value = this.checked ? 1 : 0;" />
                                            <label for="switch_status" data-on-label="" data-off-label=""></label>
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
