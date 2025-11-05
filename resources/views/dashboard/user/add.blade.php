@extends('layouts.dashboard')
@section('add-user')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                        <li class="breadcrumb-item active">Add Users</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Users</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Add User</h4>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="custom-styles-preview">
                            <form class="needs-validation" id="userForm" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data"  validate>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="validationCustom01" placeholder="Name">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustomUsername">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="validationCustomUsername" placeholder="Email" aria-describedby="inputGroupPrepend" autocomplete="off">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">User Role</label>
                                            <select class="form-select" name="roles">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role }}" {{ old('roles', $user->roles ?? '') === $role ? 'selected' : '' }} >
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status: <span style="color:red">*</span></label></br/>
                                            <input  type="checkbox" name="status"  id="switch3"  value="1"  checked  data-switch="success" onchange="this.value = this.checked ? 1 : 0;" />
                                            <label for="switch3" data-on-label="" data-off-label=""></label>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">Phone Number</label>
                                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="validationCustom02" placeholder="Phone Number">
                                            @error('phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom04">Password</label>
                                            <div class="input-group">
                                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="validationCustom04" placeholder="Password"  autocomplete="new-password">
                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="mdi mdi-eye"id="togglePasswordIcon"></i>
                                            </button>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Upload Image</label>
                                            <input type="file" name="profile_image" class="form-control" >
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
