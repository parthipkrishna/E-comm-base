<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Indeed Nutrition</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dashboard/logo/Favcon.png') }}">

        <!-- Daterangepicker css -->
        <link href="{{asset('dashboard/assets/vendor/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css">

        <!-- Vector Map css -->
        <link href="{{asset('dashboard/assets/vendor/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Theme Config Js -->
        <script src="{{asset('dashboard/assets/js/hyper-config.js')}}"></script>

        <!-- App css -->
        <link href="{{ asset('dashboard/assets/css/app-saas.min.css') }}" rel="stylesheet"  type="text/css" id="app-style" />
        <link href="https://cdn.jsdelivr.net/npm/switchery@0.8.2/dist/switchery.min.css" rel="stylesheet">
        <!-- Icons css -->
        <link href="{{asset('dashboard/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/logo/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/logo/Fav_icon_32X32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/logo/favIcon16X16') }}">
        <link rel="manifest" href="/site.webmanifest">
        <!-- Datatables css -->
        <link href="{{asset('dashboard/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- file upload css -->
        <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/dropzone/dropzone.min.css') }}">
        <!-- Select2 css -->
        <link href="{{ asset('dashboard/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Quill css -->
        {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" /> --}}
        <link rel="stylesheet" href="assets/vendor/quill/text-editor.css">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <!--icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    </head>
    <body>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Topbar Start ========== -->
            <div class="navbar-custom">
                <div class="topbar container-fluid">
                    <div class="d-flex align-items-center gap-lg-2 gap-1">
                        <!-- Topbar Brand Logo -->
                        <div class="logo-topbar">
                            <!-- Logo light -->
                            <a href="{{ route('/home') }}" class="logo-light">
                                <span class="logo-lg">
                                    <img src="{{ asset('dashboard/logo/indeed_logo.png') }}" alt="logo" >
                                </span>
                                <span class="logo-sm">
                                    <img src="{{ asset('dashboard/logo/indeed_logo.png') }}" alt="small logo">
                                </span>
                            </a>
                            <!-- Logo Dark -->
                            <a href="{{ route('/home') }}" class="logo-dark">
                                <span class="logo-lg">
                                    <img src="{{ asset('dashboard/logo/indeed_logo.png') }}" alt="dark logo">
                                </span>
                                <span class="logo-sm">
                                    <img src="{{ asset('dashboard/logo/indeed_logo.png') }}" alt="small logo">
                                </span>
                            </a>
                        </div>
                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <!-- Horizontal Menu Toggle Button -->
                        <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>
                        <!-- Topbar Search Form -->
                    </div>
                    <ul class="topbar-menu d-flex align-items-center gap-3">
                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="{{ !empty( auth()->user()->profile_image) ? env('STORAGE_URL') . '/' . str_replace('public/', '', auth()->user()->profile_image) : asset('dashboard/assets/images/avathar.png') }}"
                                        alt="admin-image" width="40" height="40" class="rounded-circle">
                                </span>

                                <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ auth()->user()->name }}</h5>
                                    <h5 class="my-0">{{ auth()->user()->roles }}</h5>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                                <!-- item-->
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="{{ route('admin-profile') }}" class="dropdown-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <form action="{{ route('admin-logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item border-0 bg-transparent w-100 text-start">
                                        <i class="mdi mdi-logout me-1"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ========== Topbar End ========== -->

            <!-- ========== Left Sidebar Start ========== style="height: 90px; width: 50%; margin-top: 10px;"-->
            <div class="leftside-menu">
                <!-- Brand Logo Light -->
                <a href="{{ route('home.dashboard') }}"" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('dashboard/logo/indeed_logo.png') }}" alt="logo" style=" width: 60%; height: 60px; margin-top: 40px;">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('dashboard/logo/indeed_logo_sm.png') }}" alt="small logo">
                    </span>
                </a>
                <!-- Brand Logo Dark -->
                <a href="{{ route('home.dashboard') }}"" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('dashboard/logo/indeed_logo.png') }}" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('dashboard/logo/indeed_logo_sm.png') }}" alt="small logo">
                    </span>
                </a>
                <!-- Sidebar Hover Menu Toggle Button -->
                <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
                    <i class="ri-checkbox-blank-circle-line align-middle"></i>
                </div>

                <!-- Full Sidebar Menu Close Button -->
                <div class="button-close-fullsidebar">
                    <i class="ri-close-fill align-middle"></i>
                </div>

                <!-- Sidebar -->
                <div class="h-100" id="leftside-menu-container" data-simplebar>
                    <!-- Leftbar User -->
                    <div class="leftbar-user">
                        <a href="#">
                            <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                                class="rounded-circle shadow-sm">
                            <span class="leftbar-user-name mt-2"></span>
                        </a>
                    </div>

                    <!--- Sidemenu -->
                    <ul class="side-nav mt-3 mb-4">
                        <li class="side-nav-item">
                            <a href="{{ route('home.dashboard') }}" class="side-nav-link">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="side-nav-title">User Management</li>
                        @if(auth()->user()->roles != 'Staff')
                            <li class="side-nav-item">
                                <a href="{{ route('users.show') }}" class="side-nav-link">
                                    <i class="fa-solid fa-user"></i>
                                    <span> Users</span>
                                </a>
                            </li>
                        @endif
                        <li class="side-nav-item">
                            <a href="{{ route('customers.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-users"></i>
                                <span> Customers</span>
                            </a>
                        </li>

                        <li class="side-nav-title">Product Management</li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.product.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-box"></i>
                                <span> Products</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('category.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-list"></i>
                                <span> Category </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.stock.show') }}" class="side-nav-link">
                                <i class="fas fa-clipboard-list"></i>
                                <span> Stock Report </span>
                            </a>
                        </li>

                        <li class="side-nav-title">Order Management</li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.order.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span> All Orders </span>
                            </a>
                        </li>
                        
                        <li class="side-nav-title">Company Management</li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.homebanner.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-image"></i>
                                <span> Home Banner </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.homesection.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-house"></i>
                                <span> Home Section </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.companyinfo.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-building"></i>
                                <span> Company info </span>
                            </a>
                        </li>
                        
                        <li class="side-nav-title">Marketing</li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.inbox.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-envelope"></i>
                                <span> Inbox</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.faq.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-question-circle"></i>
                                <span> FAQ's</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.socialmedia.show') }}" class="side-nav-link">
                                <i class="fa-solid fa-share-nodes"></i>
                                <span> Social Media Links</span>
                            </a>
                        </li>
                    </ul>
                    <!--- End Sidemenu -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- ========== Left Sidebar End ========== -->
            <!-- ============================================================== -->
            <!-- Start Page Content Here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        @yield('home')
                        @yield('add-user')
                        @yield('list-user')
                        @yield('gallery')
                        @yield('add-gallery')
                        @yield('packages')
                        @yield('add-package')
                        @yield('list-package')
                        @yield('view-package')
                        @yield('list-destination')
                        @yield('list-booking')
                        @yield('add-booking')
                        @yield('view-booking')
                        @yield('list-company-info')
                        @yield('home-section')
                        @yield('home-section-add')
                        @yield('home-banner')
                        @yield('add-banner')
                        @yield('notes')
                        @yield('add-note')
                        @yield('edit-product')
                        @yield('analytics')
                        @yield('add-faq')
                        @yield('list-faq')
                        @yield('list-socialmedia')
                        @yield('add-socialmedia')
                        @yield('list-order')
                        @yield('admin-home')
                        @yield('admin-profile')
                    </div>
                    <!-- container -->
                </div>
                <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © INNERIX TECHNOLOGIES LLP
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
         <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.collapse').forEach(el => {
                    el.classList.remove('show');
                });
            });
         </script>
         <script src="https://cdn.jsdelivr.net/npm/switchery@0.8.2/dist/switchery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset('dashboard/assets/js/vendor.min.js')}}"></script>

        <!-- Daterangepicker js -->
        <script src="{{asset('dashboard/assets/vendor/daterangepicker/moment.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/vendor/daterangepicker/daterangepicker.js')}}"></script>

        <!-- Apex Charts js -->
        <script src="{{asset('dashboard/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

        <!-- Vector Map Js -->
        <script src="{{asset('dashboard/assets/vendor/jsvectormap/js/jsvectormap.min.js')}}"></script>
        <script src="{{asset('dashboard/assets/vendor/jsvectormap/maps/world-merc.js')}}"></script>
        <script src="{{asset('dashboard/assets/vendor/jsvectormap/maps/world.js')}}"></script>

        <!-- Dashboard App js -->
        <script src="{{asset('dashboard/assets/js/pages/demo.dashboard.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('dashboard/assets/js/app.min.js')}}"></script>

        <!-- Datatables js -->
        <script src="{{ asset('dashboard/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Datatable Demo Aapp js -->
        <script src="{{ asset('dashboard/assets/js/pages/demo.datatable-init.js') }}"></script>

        <!-- Datatable js -->
        <script src="{{ asset('dashboard/assets/vendor/jquery-datatables-checkboxes/js/dataTables.checkboxes.min.js') }}"></script>
        <!-- Product Demo App js -->
        <script src="{{ asset('dashboard/assets/js/pages/demo.products.js') }}"></script>

        <!-- Code Highlight js -->
        <script src="{{ asset('dashboard/assets/vendor/highlightjs/highlight.pack.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/vendor/clipboard/clipboard.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/hyper-syntax.js') }}"></script>

        <!-- Dropzone File Upload js -->
        <script src="{{ asset('dashboard/assets/vendor/dropzone/dropzone-min.js') }}"></script>

        <!-- File Upload Demo js -->
        <script src="{{ asset('dashboard/assets/js/ui/component.fileupload.js') }}"></script>

        <!-- plugin js -->
        <script src="{{ asset('dashboard/assets/vendor/dropzone/min/dropzone.min.js') }}"></script>

        <!--  Select2 Js -->
        <script src="{{ asset('dashboard/assets/vendor/select2/js/select2.min.js') }}"></script>

        <!-- Initialize Quill editor -->
        <script src="{{asset('dashboard/assets/vendor/quill/text-editor.js') }}"></script>

        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- Chart.js-->
        <script src="{{'assets/vendor/chart.js/chart.min.js'}}"></script>
        <!-- Sparkline Chart js -->
        <script src="{{ asset('dashboard/assets/vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <!-- Sparkline Chart Demo js -->
        <script src="{{ asset('dashboard/assets/js/pages/demo.sparkline.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script src="{{ asset('dashboard/assets/js/pages/validation.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.datatable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true
                });
            });
        </script>

        <script>
            
        </script>
        <script>
            
        </script>
        <script>
            
        </script>
        <script>
            
        </script>
        <script>
            
        </script>



        <!-- Initialize Quill editor -->
        <script>
            var editor = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Write something...',
                // Any other configuration you need
            });

            var editor2 = new Quill('#editor2', {
                theme: 'snow',
                placeholder: 'Write something...',
                // Any other configuration you need
            });

        </script>

        <script>
            // Toggle file upload section based on media type
            document.getElementById('media_type').addEventListener('change', function() {
                const mediaType = this.value;

                if (mediaType === 'VIDEO') {
                    document.getElementById('image-upload-section').style.display = 'none';
                    document.getElementById('youtube-upload-section').style.display = 'none';
                    document.getElementById('video-upload-section').style.display = 'block';
                } else if (mediaType === 'IMAGE') {
                    document.getElementById('image-upload-section').style.display = 'block';
                    document.getElementById('video-upload-section').style.display = 'none';
                    document.getElementById('youtube-upload-section').style.display = 'none';
                } else if (mediaType === 'YOUTUBE') {
                    document.getElementById('youtube-upload-section').style.display = 'block';
                    document.getElementById('image-upload-section').style.display = 'none';
                    document.getElementById('video-upload-section').style.display = 'none';
                } else {
                    // In case no option is selected, hide both sections
                    document.getElementById('image-upload-section').style.display = 'none';
                    document.getElementById('video-upload-section').style.display = 'none';
                    document.getElementById('youtube-upload-section').style.display = 'none';
                }
            });

            // Initialize with default setting based on current selection (if any)
            document.addEventListener('DOMContentLoaded', function() {
                const mediaType = document.getElementById('media_type').value;

                if (mediaType === 'VIDEO') {
                    document.getElementById('video-upload-section').style.display = 'block';
                    document.getElementById('image-upload-section').style.display = 'none';
                    document.getElementById('youtube-upload-section').style.display = 'none';
                } else if (mediaType === 'IMAGE') {
                    document.getElementById('image-upload-section').style.display = 'block';
                    document.getElementById('video-upload-section').style.display = 'none';
                    document.getElementById('youtube-upload-section').style.display = 'none';
                } else if (mediaType === 'YOUTUBE') {
                    document.getElementById('image-upload-section').style.display = 'none';
                    document.getElementById('video-upload-section').style.display = 'none';
                    document.getElementById('youtube-upload-section').style.display = 'block';
                } else {
                    document.getElementById('image-upload-section').style.display = 'none';
                    document.getElementById('video-upload-section').style.display = 'none';
                }
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Choose ...",
                    allowClear: true
                });
            });
        </script>

        <script>

            $(document).ready(function() {
                $('.select2').select2();  // Initialize on page load
                // Reinitialize on modal open (if dropdown is inside a modal)
                $('#editCourseModal').on('shown.bs.modal', function() {
                    $('.select2').select2();
                });
                // Reinitialize if dropdown is loaded dynamically
                $(document).on('DOMNodeInserted', function() {
                    $('.select2').select2();
                });
            });
        </script>


    </body>

</html>
