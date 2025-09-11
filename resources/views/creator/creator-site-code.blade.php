<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Site Code | RCPL</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('./img/vendor.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('./admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('./admin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('./admin/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('./admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('./admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('./admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('./admin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('./admin/assets/js/config.js') }}"></script>

    <style>
        .card-footer {
            overflow-x: auto !important;
        }

        @media screen and (max-width: 1300px) {
            table * {
                font-size: 11px !important;
            }
        }

        .custom-success-popup,
        .custom-error-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            z-index: 9999;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeInOut 4s ease-in-out forwards;
        }

        .custom-success-popup {
            background-color: #4CAF50;
        }

        .custom-error-popup {
            background-color: #f44336;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            10% {
                opacity: 1;
                transform: translateY(0);
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        /* CSS */
        .fab {
            position: fixed;
            right: max(30px, env(safe-area-inset-right));
            bottom: max(30px, env(safe-area-inset-bottom));
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #6366F1;
            /* indigo-500 */
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .15), 0 6px 6px rgba(0, 0, 0, .10);
            text-decoration: none;
            z-index: 9999;
            transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
        }

        .fab:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 24px rgba(0, 0, 0, .18), 0 8px 8px rgba(0, 0, 0, .12);
        }

        .fab:active {
            transform: translateY(0);
        }

        .fab:focus-visible {
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, .35), 0 10px 20px rgba(0, 0, 0, .15);
        }

        @media (max-width: 480px) {
            .fab {
                width: 52px;
                height: 52px;
            }
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside
                id="layout-menu"
                class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="admin-dashboard.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('./img/vendor.png') }}" width="50px" alt="" />
                        </span>
                        <span
                            class="app-brand-text demo menu-text fw-bolder ms-2"
                            style="text-transform: capitalize">RCPL</span>
                    </a>

                    <a
                        href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>
                <!-- Sidebar -->
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="{{ route('creator.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>


                    <!-- Accounts -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Create</span>
                    </li>

                    <!-- Cards -->
                    <li class="menu-item active">
                        <a href="{{ route('creator.site-code-create') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx  bx-building-house'></i>
                            <div data-i18n="Classewes">Add Site Code</div>
                        </a>
                    </li>

                    <!-- Cards -->
                    <li class="menu-item">
                        <a href="{{ route('creator.vendor-create') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx  bx-user-plus'></i>
                            <div data-i18n="Classes">Create Vendors</div>
                        </a>
                    </li>

                    <!-- Setting -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Profile</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('creator.profile') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Enquiry">Profile Details</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav
                    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div
                        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a
                            class="nav-item nav-link px-0 me-xl-4"
                            href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div
                        class="navbar-nav-right d-flex align-items-center"
                        id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">


                            <form method="GET" action="{{ route('creator.site-code-create') }}" class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    class="form-control border shadow-none"
                                    placeholder="Search..."
                                    aria-label="Search..." />
                                &nbsp;&nbsp;
                                <button class="btn btn-primary" type="submit">Search</button>&nbsp;&nbsp;
                                <a href="{{ route('creator.site-code-create') }}" class="btn btn-secondary">Reset</a>
                            </form>


                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a
                                    class="nav-link dropdown-toggle hide-arrow"
                                    href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img
                                            src="{{ asset('./admin/assets/img/avatars/1.png') }}"
                                            alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img
                                                            src="{{ asset('./admin/assets/img/avatars/1.png') }}"
                                                            alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                                    <small class="text-muted">Creator</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('creator.profile') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('creator.logout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">
                                                    Add Site Code
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img
                                                    src="{{ asset('./admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                                    height="80"
                                                    alt="View Badge User" />
                                            </div>

                                            <a href="{{ route('creator.site-codes-export') }}" class="btn btn-info">Export As Excel</a>
                                        </div>

                                        <div class="col-12">
                                            <div class="card-footer text-end">
                                                <table class="table responsive table-bordered table-hover" style="text-align: left;">
                                                    <thead>
                                                        <tr>
                                                            <th>SL.</th>
                                                            <th>Site Code</th>
                                                            <th>Site Name</th>
                                                            <th>Location</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($sites as $site)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td style="text-transform: uppercase;">{{ $site->site_code }}</td>
                                                            <td style="text-transform: uppercase;">{{ $site->site_name }}</td>
                                                            <td style="text-transform: uppercase;">{{ $site->location }}</td>
                                                            <td>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#edit{{ $site->id }}" data-bs-backdrop="static" class="btn btn-sm btn-warning"><i class='bx  bx-edit'></i></button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $site->id }}" data-bs-backdrop="static" class="btn btn-sm btn-danger"><i class='bx  bx-trash'></i></button>

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>


                                                <!-- Pagination Controls -->
                                                @if ($sites->hasPages())
                                                <nav aria-label="Vendor pagination">
                                                    <ul class="pagination justify-content-center mt-4 align-items-center">

                                                        <!-- Prev Button -->
                                                        <li class="page-item {{ $sites->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link btn btn-primary"
                                                                href="{{ $sites->previousPageUrl() }}">Prev</a>
                                                        </li>
                                                        &nbsp;

                                                        <!-- Page Input + Total -->
                                                        <li class="page-item d-flex align-items-center" style="margin: 0 2px;">
                                                            <form action="" method="GET" class="d-flex align-items-center" style="margin:0; padding:0;">
                                                                <input type="number" name="page"
                                                                    value="{{ $sites->currentPage() }}"
                                                                    min="1"
                                                                    max="{{ $sites->lastPage() }}"
                                                                    readonly
                                                                    class="form-control" style="width: 60px; text-align: center;">
                                                                <input type="text"
                                                                    value="/ {{ $sites->lastPage() }}"
                                                                    readonly
                                                                    class="form-control" style="width: 60px; text-align: center;">
                                                            </form>
                                                        </li>
                                                        &nbsp;

                                                        <!-- Next Button -->
                                                        <li class="page-item {{ !$sites->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link btn btn-primary"
                                                                href="{{ $sites->nextPageUrl() }}">Next</a>
                                                        </li>

                                                    </ul>
                                                </nav>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->


                    <!-- HTML -->
                    <a data-bs-toggle="modal" data-bs-target="#add" data-bs-backdrop="static" class="fab" aria-label="Add new item" title="Add" style="color: white; cursor: pointer;">
                        <!-- plus icon -->
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </a>

                    <!-- Add Modal -->
                    <div class="modal fade" id="add" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" action="{{ route('creator.site-code-create.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addLabel">Add Site Code</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <!-- site_code -->
                                        <div class="col-md-12 mb-3">
                                            <label for="site_code" class="form-label">Site Code<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="site_code" name="site_code" value="{{ old('site_code') }}" required>
                                            {{-- Validation Errors for Site Code --}}
                                            @error('site_code')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- site_name -->
                                        <div class="col-md-12 mb-3">
                                            <label for="site_name" class="form-label">Site Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name') }}" required>
                                        </div>

                                        <!-- Vendor Code -->
                                        <div class="col-md-12 mb-3">
                                            <label for="vendor_code" class="form-label">Location<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Site Code</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    @foreach($sites as $site)
                    <div class="modal fade" id="edit{{ $site->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" action="{{ route('creator.site-code-create.update', $site->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addLabel">Edit Site Code</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <!-- site_code -->
                                        <div class="col-md-12 mb-3">
                                            <label for="site_code" class="form-label">Site Code<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="site_code" name="site_code" value="{{$site->site_code}}">
                                            {{-- Validation Errors for Site Code --}}
                                            @error('site_code')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- site_name -->
                                        <div class="col-md-12 mb-3">
                                            <label for="site_name" class="form-label">Site Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{$site->site_name}}">
                                        </div>

                                        <!-- Vendor Code -->
                                        <div class="col-md-12 mb-3">
                                            <label for="vendor_code" class="form-label">Location<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="location" name="location" value="{{$site->location}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Site Code</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- Delete Modal -->
                    @foreach($sites as $site)
                    <div class="modal fade" id="delete{{ $site->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" action="{{ route('creator.site-code-create.delete', $site->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addLabel">Delete Site Code</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <p>Are you sure you want to delete this site code?</p>
                                    <p class="text-danger" style="text-transform: uppercase;">{{ $site->site_code }}</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete Site Code</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach





                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a
                                    href="https://github.com/artic0909"
                                    target="_blank"
                                    class="footer-link fw-bolder">Saklinmustak</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @if (session('success'))
    <div id="successPopup" class="custom-success-popup">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div id="errorPopup" class="custom-error-popup">
        {{ session('error') }}
    </div>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successPopup = document.getElementById('successPopup');
            const errorPopup = document.getElementById('errorPopup');

            if (successPopup) setTimeout(() => successPopup.remove(), 4000);
            if (errorPopup) setTimeout(() => errorPopup.remove(), 4000);
        });
    </script>

    <!-- Core JS -->
    <script src="{{ asset('./admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('./admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('./admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('./admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('./admin/assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('./admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('./admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <!-- JS for Vendor Code -->
    <script>
        document.getElementById('generateCode').addEventListener('click', function() {
            const stateCode = document.getElementById('state_code').value;
            const vendorName = document.getElementById('vendor_name').value.trim();

            if (!stateCode || !vendorName) {
                alert("Please select state & enter vendor name first!");
                return;
            }

            const firstFour = vendorName.substring(0, 4).toLowerCase().replace(/\s+/g, '');
            const now = new Date();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const year = String(now.getFullYear()).slice(-2);

            const code = `${stateCode}-${firstFour}-${month}${year}`;
            document.getElementById('vendor_code').value = code;
        });
    </script>

    @if($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('add'));
            myModal.show();
        });
    </script>
    @endif


</body>

</html>