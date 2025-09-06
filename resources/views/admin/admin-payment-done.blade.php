<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Payments Done | RCPL</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('./img/rupee.png') }}" />

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
                            <img src="{{ asset('./img/RCPL.png') }}" width="50px" alt="" />
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
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>


                    <!-- Admin -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Requests</span>
                    </li>
                    <!-- Cards -->
                    <li class="menu-item">
                        <a href="{{ route('admin.pending-requests') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx  bx-timer'></i>
                            <div data-i18n="Classes">Pending Requests</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.approved-requests') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-list-check"></i>
                            <div data-i18n="Class FAQs">Approved Requests</div>
                        </a>
                    </li>

                    <li class="menu-item active">
                        <a href="{{ route('admin.done-requests') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx  bx-list-check'></i>
                            <div data-i18n="Subjects">Payments Done</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.rejected-requests') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx  bx-trash'></i>
                            <div data-i18n="Subjects">Rejected Requests</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('admin.all-requests') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-list-ul"></i>
                            <div data-i18n="Chapters">All Requests</div>
                        </a>
                    </li>

                    <!-- Setting -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Profile</span>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.profile') }}" class="menu-link">
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
                            <form action="{{ route('admin.done-requests') }}" method="GET" class="d-flex align-items-center">
                                <div class="nav-item d-flex align-items-center">
                                    <i class="bx bx-search fs-4 lh-0"></i>
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="form-control border shadow-none"
                                        placeholder="Search..."
                                        aria-label="Search..." />
                                </div>

                                &nbsp;&nbsp;&nbsp;&nbsp;<p class="m-0">Search By Date:</p> &nbsp;&nbsp;

                                <div class="nav-item d-flex align-items-center">
                                    <input
                                        type="date"
                                        name="date"
                                        value="{{ request('date') }}"
                                        class="form-control border shadow-none" />
                                </div>&nbsp;&nbsp;

                                <button class="btn btn-primary" type="submit">Search</button>&nbsp;&nbsp;

                                <a href="{{ route('admin.done-requests') }}" class="btn btn-secondary">Reset</a>
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
                                                    <small class="text-muted">Accounts</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
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
                                                    All Payment Requests
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img
                                                    src="{{ asset('./img/get-money.png') }}"
                                                    height="80"
                                                    alt="View Badge Get Money" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card-footer text-end">
                                                <table class="table responsive table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Approval Status</th>
                                                            <th scope="col">Payment Status</th>
                                                            <th scope="col">Site Name</th>
                                                            <th scope="col">Request For</th>
                                                            <th scope="col">Item Description</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Vendor Details</th>
                                                            <th scope="col">Staff Details</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($paymentRequestDetails as $request)
                                                        <tr style="text-align: left;">
                                                            <td><strong>{{ $request->date?->format('d M Y') }}</strong></td>
                                                            <td>
                                                                @if($request->status == 'pending')
                                                                <span class="badge rounded bg-label-warning fw-bold">{{ $request->status }}</span>
                                                                @elseif($request->status == 'approved')
                                                                <span class="badge rounded bg-label-success fw-bold">{{ $request->status }}</span>
                                                                @elseif($request->status == 'rejected')
                                                                <span class="badge rounded bg-label-danger fw-bold">{{ $request->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($request->payment_status == 'Pending')
                                                                <span class="badge rounded bg-label-warning fw-bold">{{ $request->payment_status }}</span>
                                                                @elseif($request->payment_status == 'Done')
                                                                <span class="badge rounded bg-label-success fw-bold">{{ $request->payment_status }}</span>
                                                                @endif
                                                            </td>
                                                            <td><span class="badge rounded bg-label-primary fw-bold" style="white-space: normal; word-wrap: break-word; max-width: 130px; line-height: 1.2;">{{ $request->site_name }}</span></td>
                                                            <td>
                                                                @if(!empty($request->request_for))
                                                                <ul style="text-align: left; list-style-type: decimal;">
                                                                    @foreach($request->request_for as $req)
                                                                    <li>{{ $req }}</li>
                                                                    @endforeach
                                                                </ul>
                                                                @else
                                                                <span>No Request Found</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <p class="m-0" style="white-space: normal; word-wrap: break-word; max-width: 130px;">
                                                                    <small>{{ $request->item_description }}</small>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                @if($request->payment_status == 'Pending')
                                                                <span class="badge rounded bg-label-warning fs-6 fw-bold">₹ {{ number_format($request->amount, 2) }}</span>
                                                                @elseif($request->payment_status == 'Done')
                                                                <span class="badge rounded bg-label-success fs-6 fw-bold">₹ {{ number_format($request->amount, 2) }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <p class="m-0"><strong>{{ $request->vendor_name }}</strong></p>
                                                                <p class="m-0">CD: <strong>{{ $request->vendor_code }}</strong></p>
                                                                <!-- <p class="m-0">Acc: <strong>{{ $request->party_account_number }}</strong></p>
                                                                <p class="m-0">IFSC: <strong>{{ $request->party_ifsc_code }}</strong></p>
                                                                <p class="m-0">Bank: <strong>{{ $request->party_bank_name }}</strong></p>
                                                                <p class="m-0">Branch: <strong>{{ $request->party_bank_branch_name }}</strong></p> -->
                                                            </td>
                                                            <td>
                                                                <p class="m-0">{{ $request->user->name }}</p>
                                                                <p class="m-0">CD: {{ $request->user->staff_code }}</p>
                                                            </td>
                                                            <td>
                                                                @if($request->payment_status == 'Pending' && $request->status == 'approved')
                                                                <a href="{{ route('admin.payment.pdf.view', $request->id) }}" class="btn btn-primary mb-2"><i class='bx bx-file'></i></a>
                                                                @elseif($request->payment_status == 'Done' && $request->status == 'approved')
                                                                <a href="{{ route('admin.payment.pdf.view', $request->id) }}" class="btn btn-success mb-2"><i class='bx bx-file'></i></a>
                                                                @elseif($request->payment_status == 'Pending' && $request->status == 'pending')
                                                                <a href="{{ route('admin.payment.pdf.view', $request->id) }}" class="btn btn-warning mb-2"><i class='bx bx-file'></i></a>
                                                                @elseif($request->payment_status == 'Pending' && $request->status == 'rejected')
                                                                <a href="{{ route('admin.payment.pdf.view', $request->id) }}" class="btn btn-danger mb-2"><i class='bx bx-file'></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                                <!-- {{-- Pagination --}} -->
                                                @if ($paymentRequestDetails->hasPages())
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination justify-content-center mt-4 align-items-center">

                                                        <!-- {{-- Prev Button --}} -->
                                                        <li class="page-item {{ $paymentRequestDetails->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link btn btn-primary"
                                                                href="{{ $paymentRequestDetails->previousPageUrl() }}">Prev</a>
                                                        </li>
                                                        &nbsp;
                                                        <!-- {{-- Page Input + Total --}} -->
                                                        <li class="page-item d-flex align-items-center" style="margin: 0 2px;">
                                                            <form action="" method="GET" class="d-flex align-items-center" style="margin:0; padding:0;">
                                                                <input type="number" name="page"
                                                                    value="{{ $paymentRequestDetails->currentPage() }}"
                                                                    min="1"
                                                                    max="{{ $paymentRequestDetails->lastPage() }}"
                                                                    readonly
                                                                    class="form-control">
                                                                <input type="text"
                                                                    value="/ {{ $paymentRequestDetails->lastPage() }}"
                                                                    readonly
                                                                    class="form-control">
                                                            </form>
                                                        </li>
                                                        &nbsp;
                                                        <!-- {{-- Next Button --}} -->
                                                        <li class="page-item {{ !$paymentRequestDetails->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link btn btn-primary"
                                                                href="{{ $paymentRequestDetails->nextPageUrl() }}">Next</a>
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
</body>

</html>