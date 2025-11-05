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
                            <a href="{{ route('admin.faq.add') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add </a>
                        </div>
                        <div class="col-sm-7">
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="faqs-datatable">
                        <thead class="table-dark">
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($faqs as $faq)
                                <tr>
                                    <td>{{ $faq->question }}</td>
                                    <td>{{ Str::limit($faq->answer, 100) }}</td>
                                    <td>
                                        @if ($faq->status)
                                            <button type="button" class="btn btn-soft-success rounded-pill">Active</button>
                                        @else
                                            <button type="button" class="btn btn-soft-danger rounded-pill">Inactive</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#edit-faq-modal{{ $faq->id }}">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#delete-faq-modal{{ $faq->id }}">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            <!-- Edit Modal-->
                            <div class="modal fade" id="edit-faq-modal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="editFaqLabel{{ $faq->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editFaqLabel{{ $faq->id }}">Edit FAQ</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.faq.update/{id}', $faq->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <!-- Left Column -->
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="question{{ $faq->id }}" class="form-label">Question</label>
                                                            <textarea name="question" class="form-control" id="question{{ $faq->id }}" required>{{ $faq->question }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="answer{{ $faq->id }}" class="form-label">Answer</label>
                                                            <textarea name="answer" class="form-control" id="answer{{ $faq->id }}" required>{{ $faq->answer }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="status{{ $faq->id }}" class="form-label">Status</label><br>
                                                            <input type="hidden" name="status" value="0">
                                                            <input type="checkbox" name="status" id="switch-status{{ $faq->id }}" value="1" {{ $faq->status ? 'checked' : '' }} data-switch="success" />
                                                            <label for="switch-status{{ $faq->id }}" data-on-label="" data-off-label=""></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->



                                    <div id="delete-faq-modal{{ $faq->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-body p-4">
                                                    <div class="text-center">
                                                        <i class="ri-information-line h1 text-info"></i>
                                                        <h4 class="mt-2">Heads up!</h4>
                                                        <p class="mt-3">Do you want to delete this FAQ?</p>
                                                        <form action="{{ route('admin.faq.delete/{id}', $faq->id) }}" method="POST">
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
