@extends('layouts.dashboard')
@section('admin-profile')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
                <h4 class="page-title">Profile</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-sm-12">
            <!-- Profile -->
            <div class="card bg-primary">
                <div class="card-body profile-user-box">
                    <div class="row">
                        @if($user)
                            <div class="col-sm-10">


                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-lg">
                                            <img src="{{ !empty( auth()->user()->profile_image) ? env('STORAGE_URL') . '/' . str_replace('public/', '', auth()->user()->profile_image) : asset('dashboard/assets/images/avathar.png') }}" alt="" height="90"
                                                class="rounded-circle img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <h4 class="mt-1 mb-1 text-white">{{ $user->name }}</h4>
                                            <p class="font-13 text-white-50"> Admin</p>

                                            <ul class="mb-0 list-inline text-light mt-3">

                                                <li class="list-inline-item me-5">
                                                    <h5 class="mb-1 text-white">{{ $user->email }}</h5>
                                                    <p class="mb-0 font-13 text-white-50">Email
                                                    </p>
                                                </li>
                                                <li class="list-inline-item ">
                                                    <h5 class="mb-1 text-white">{{ $user->phone }}</h5>
                                                    <p class="mb-0 font-13 text-white-50">Phone
                                                    </p>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end col-->

                            <div class="col-sm-2">
                                <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                    <button type="button" class="btn btn-light">
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#bs-editProfile-modal{{ $user->id }}">
                                            <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                                        </a>
                                    </button>
                                </div>
                            </div> <!-- end col-->

                            <!-- Edit Modal-->
                            <div class="modal fade" id="bs-editProfile-modal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editProfileLabel{{ $user->id }}">Edit Profile</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('adminprofile.update/{id}', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <!-- Center Name -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="center_name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="center_name" name="name" value="{{ $user['name'] }}">
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Current Image</label><br>
                                                            @if ($user->profile_image)
                                                                <img src="{{ env('STORAGE_URL') . '/' . str_replace('public/', '', auth()->user()->profile_image) }}" class="me-2 img-fluid avatar-xl">
                                                            @else
                                                                <span class="small text-danger">No Image</span>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Upload New Image</label>
                                                            <input type="file" name="profile_image" class="form-control">
                                                        </div>
                                                    </div>

                                                    <!-- Address -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone Number</label>
                                                            <input type="text" class="form-control" id="phone" name="phone_number" value="{{ $user->phone }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="validationCustom04">New Password</label>
                                                            <div class="input-group">
                                                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="validationCustom04" placeholder="Password" autocomplete="new-password">
                                                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                                    <i class="mdi mdi-eye" id="togglePasswordIcon"></i>
                                                                </button>
                                                            </div>
                                                        </div>   
                                                    </div>  
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->


                        @else
                            <p class="text-danger">User not found.</p>
                        @endif
                    </div> <!-- end row -->

                </div> <!-- end card-body/ profile-user-box-->
            </div><!--end profile/ card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#validationCustom04');
        const toggleIcon = document.querySelector('#togglePasswordIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>

@endsection
