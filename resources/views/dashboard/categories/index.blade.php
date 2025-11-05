@extends('layouts.dashboard')
@section('list-user')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Categories</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
                <h4 class="page-title">Categories</h4>
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
                            <a href="{{ route('category.add') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add </a>
                        </div>
                        <div class="col-sm-7">
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="categories-datatable">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="table-user">
                                        @if ($category->image)
                                            <img src="{{ env('STORAGE_URL') . '/' . $category->image }}" class="me-2 rounded-circle" alt="category image" height="40">
                                        @else
                                            <span class="small text-danger">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description ?? 'No description available' }}</td>
                                    <td>
                                        <div>
                                            <input type="checkbox"
                                                id="switch{{ $category->id }}"
                                                data-id="{{ $category->id }}"
                                                class="category-status-toggle"
                                                {{ $category->status == 1 ? 'checked' : '' }}
                                                data-switch="success" />
                                            <label for="switch{{ $category->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block" style="cursor: pointer;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#edit-category-modal{{ $category->id }}">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#delete-category-modal{{ $category->id }}">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                    <!-- Edit Modal-->
                                    <div class="modal fade" id="edit-category-modal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel{{ $category->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="editCategoryLabel{{ $category->id }}">Edit Category</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('category.update/{id}', $category->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <!-- Left Column -->
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="name{{ $category->id }}" class="form-label">Category Name</label>
                                                                    <input type="text" class="form-control" id="name{{ $category->id }}" name="name" value="{{ $category->name }}">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="description{{ $category->id }}" class="form-label">Description</label>
                                                                    <textarea class="form-control" id="description{{ $category->id }}" name="description">{{ $category->description }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label><br>
                                                                    <input type="hidden" name="status" value="0">
                                                                    <input type="checkbox" name="status" id="switch-status{{ $category->id }}" value="1" {{ $category->status ? 'checked' : '' }} data-switch="success" />
                                                                    <label for="switch-status{{ $category->id }}" data-on-label="" data-off-label=""></label>
                                                                </div>

                                                                {{-- <div class="mb-3">
                                                                    <label for="parent_id{{ $category->id }}" class="form-label">Parent Category</label>
                                                                    <select name="parent_id" id="parent_id{{ $category->id }}" class="form-select">
                                                                        <option value="">-- None --</option>
                                                                        @foreach($categories as $parent)
                                                                            @if ($parent->id !== $category->id)
                                                                                <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                                                                                    {{ $parent->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div> --}}
                                                            </div>

                                                            <!-- Right Column -->
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="image_current" class="form-label">Current Image</label><br>
                                                                    @if ($category->image)
                                                                        <img src="{{ env('STORAGE_URL') . '/' . $category->image }}" class="img-fluid avatar-xl">
                                                                    @else
                                                                        <span class="small text-danger">No Image</span>
                                                                    @endif
                                                                </div>
                                                               <div class="mb-3">
                                                                    <label for="image" class="form-label">Upload New Image</label>
                                                                    <input type="file" name="image" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                        <div id="delete-category-modal{{ $category->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="ri-information-line h1 text-info"></i>
                                                            <h4 class="mt-2">Heads up!</h4>
                                                            <p class="mt-3">Do you want to delete this category?</p>
                                                            <form action="{{ route('category.delete/{id}', $category->id) }}" method="POST">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.category-status-toggle').on('change', function () {
                var categoryId = $(this).data('id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('admin.category.toggleStatus') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        category_id: categoryId,
                        status: status
                    },
                    success: function (response) {
            console.log('Success:', response);
        },
        error: function (xhr) {
            console.log('Error:', xhr.responseText);
        }

                });
            });
        });
    </script>
@endsection
