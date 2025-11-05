@extends('layouts.dashboard')
@section('home-section')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home sections</a></li>
                        <li class="breadcrumb-item active">sections</li>
                    </ol>
                </div>
                <h4 class="page-title">Home Sections</h4>
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
                            <a href="{{ route('admin.homesection.add') }}" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add </a>
                        </div>
                        <div class="col-sm-7">
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0  w-100 dt-responsive nowrap" id="home-sections-datatable">
                        <thead class="table-dark">
                            <tr>
                                <th>Background Image</th>
                                <th>Mockup Image</th>
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($home_sections as $section)
                                <tr>
                                    <td>
                                        @if ($section->bg_image)
                                            <img src="{{ env('STORAGE_URL') . '/' . $section->bg_image }}" alt="bg image" height="40" class="rounded">
                                        @else
                                            <span class="text-danger small">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($section->mockup_image)
                                            <img src="{{ env('STORAGE_URL') . '/' . $section->mockup_image }}" alt="mockup image" height="40" class="rounded">
                                        @else
                                            <span class="text-danger small">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $section->title ?? '-' }}</td>
                                    <td>{{ $section->short_desc ?? '-' }}</td>
                                    <td>
                                        <div>
                                            <input type="checkbox"
                                                id="switch{{ $section->id }}"
                                                data-id="{{ $section->id }}"
                                                class="section-status-toggle"
                                                {{ $section->status == 1 ? 'checked' : '' }}
                                                data-switch="success" />
                                            <label for="switch{{ $section->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block" style="cursor: pointer;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#edit-home-section-modal{{ $section->id }}">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#delete-home-section-modal{{ $section->id }}">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                    <!-- Edit Modal-->
                                        <div class="modal fade" id="edit-home-section-modal{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="editHomeSectionLabel{{ $section->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="editHomeSectionLabel{{ $section->id }}">Edit Home Section</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.homesection.update/{id}', $section->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <!-- Left Column -->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="title{{ $section->id }}" class="form-label">Title</label>
                                                                        <input type="text" class="form-control" id="title{{ $section->id }}" name="title" value="{{ $section->title }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="short_desc{{ $section->id }}" class="form-label">Short Description</label>
                                                                        <textarea class="form-control" id="short_desc{{ $section->id }}" name="short_desc">{{ $section->short_desc }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="status{{ $section->id }}" class="form-label">Status</label><br>
                                                                        <input type="hidden" name="status" value="0">
                                                                        <input type="checkbox" name="status" id="switch-status{{ $section->id }}" value="1" {{ $section->status ? 'checked' : '' }} data-switch="success" />
                                                                        <label for="switch-status{{ $section->id }}" data-on-label="" data-off-label=""></label>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Current Background Image</label><br>
                                                                        @if ($section->bg_image)
                                                                            <img src="{{ env('STORAGE_URL') . '/' . $section->bg_image }}" class="img-fluid avatar-xl" style="width: 60%;">
                                                                        @else
                                                                            <span class="text-danger small">No Image</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="bg_image" class="form-label">Upload New Background Image</label>
                                                                        <input type="file" name="bg_image" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <!-- Right Column -->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Current Mockup Image</label><br>
                                                                        @if ($section->mockup_image)
                                                                            <img src="{{ env('STORAGE_URL') . '/' . $section->mockup_image }}" class="img-fluid avatar-xl" style="width: 50%;">
                                                                        @else
                                                                            <span class="text-danger small">No Image</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="mockup_image" class="form-label">Upload New Mockup Image</label>
                                                                        <input type="file" name="mockup_image" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="type">Section Type</label>
                                                                        <select name="type" class="form-control" required>
                                                                            <option value="approach" {{ $section->type == 'approach' ? 'selected' : '' }}>Approach</option>
                                                                            <option value="intro" {{ $section->type == 'intro' ? 'selected' : '' }}>Intro</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="delete-home-section-modal{{ $section->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-body p-4">
                                                        <div class="text-center">
                                                            <i class="ri-information-line h1 text-info"></i>
                                                            <h4 class="mt-2">Heads up!</h4>
                                                            <p class="mt-3">Do you want to delete this home section?</p>
                                                            <form action="{{ route('admin.homesection.delete/{id}', $section->id) }}" method="POST">
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
        $('.section-status-toggle').on('change', function () {
            var sectionId = $(this).data('id');
            var status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.section.toggleStatusAjax') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    section_id: sectionId,
                    status: status
                },
                success: function (response) {
                    console.log(response.message);
                    // Optional: toast/alert
                },
                error: function () {
                    alert('Error updating section status!');
                }
            });
        });
    });
</script>

@endsection
