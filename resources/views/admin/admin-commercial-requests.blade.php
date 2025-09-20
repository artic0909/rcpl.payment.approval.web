<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>commercial Payment Requests | RCPL</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('./img/RCPL.png') }}" />

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

                    <li class="menu-item">
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

                    <!-- Commercial -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Commercial</span>
                    </li>

                    <li class="menu-item active">
                        <a href="{{ route('admin.commercial-requests') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-rupee"></i>
                            <div data-i18n="Chapters">Commercial Requests</div>
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
                        <form action="{{ route('admin.commercial-requests') }}" method="GET" class="d-flex align-items-center">

                            <!-- Search -->
                            <div class="nav-item d-flex align-items-center me-3">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    class="form-control border shadow-none"
                                    placeholder="Search..."
                                    aria-label="Search..." />
                            </div>

                            <!-- Date Search -->
                            <div class="nav-item d-flex align-items-center me-3">
                                <label class="me-2 m-0">Search By Date:</label>
                                <input
                                    type="date"
                                    name="date"
                                    value="{{ request('date') }}"
                                    class="form-control border shadow-none" />
                            </div>

                            <!-- Buttons -->
                            <button class="btn btn-primary me-2" type="submit">Search</button>
                            <a href="{{ route('admin.commercial-requests') }}" class="btn btn-secondary">Reset</a>
                        </form>
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
                                                    <small class="text-muted">Admin</small>
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
                                                    Commercial All payment Requests
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img
                                                    src="{{ asset('./img/rupee.png') }}"
                                                    height="80"
                                                    alt="View Badge User" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card-footer text-start">
                                                <table class="table responsive table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Approval Status</th>
                                                            <th scope="col">Payment Status</th>
                                                            <th scope="col">Payment Type</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Remarks</th>
                                                            <th scope="col">Reject Remarks</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($myRequests as $request)
                                                        <tr style="text-align: left;">
                                                            <td><strong>{{ $request->date?->format('d M Y') }}</strong></td>

                                                            <td>
                                                                @if ($request->approval_status == 'pending')
                                                                <span class="badge rounded bg-label-warning fw-bold">{{ ucfirst($request->approval_status) }}</span>
                                                                @elseif ($request->approval_status == 'approved')
                                                                <span class="badge rounded bg-label-success fw-bold">{{ ucfirst($request->approval_status) }}</span>
                                                                @elseif ($request->approval_status == 'rejected')
                                                                <span class="badge rounded bg-label-danger fw-bold">{{ ucfirst($request->approval_status) }}</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($request->payment_status == 'pending')
                                                                <span class="badge rounded bg-label-warning fw-bold">{{ ucfirst($request->payment_status) }}</span>
                                                                @elseif ($request->payment_status == 'done')
                                                                <span class="badge rounded bg-label-success fw-bold">{{ ucfirst($request->payment_status) }}</span>
                                                                @endif
                                                            </td>



                                                            <td><span class="badge rounded bg-label-primary  fw-bold" style="white-space: normal; word-wrap: break-word; max-width: 130px; line-height: 1.2;">{{ $request->payment_type }}</span></td>
                                                            <td><span class="badge rounded bg-label-primary  fw-bold">₹ {{ $request->amount}} </span></td>

                                                            <td>
                                                                <p class="m-0" style="white-space: normal; word-wrap: break-word; max-width: 130px;">
                                                                    <small>{{ $request->remarks }}</small>
                                                                </p>
                                                            </td>

                                                            <td>
                                                                <p class="m-0" style="white-space: normal; word-wrap: break-word; max-width: 130px;">
                                                                    <small>{{ $request->reject_remarks ?? 'N/A'}}</small>
                                                                </p>
                                                            </td>

                                                            <td>
                                                                <div class="d-flex flex-column gap-2">
                                                                    @if ($request->approval_status == 'pending' && $request->payment_status == 'pending')
                                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve{{ $request->id }}" data-bs-backdrop="static"><i class='bx bx-check-circle'></i></button>
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $request->id }}" data-bs-backdrop="static"><i class='bx bx-edit'></i></button>
                                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remark{{ $request->id }}" data-bs-backdrop="static"><i class='bx bx-user-x'></i></button>
                                                                    @endif

                                                                    @if ($request->approval_status == 'approved' && $request->payment_status == 'pending')
                                                                    <a href="{{ route('admin.commercial-requests.pdf.show', $request->id) }}" class="btn btn-info" target="_blank"><i class='bx bx-file'></i></a>
                                                                    @endif

                                                                    @if ($request->approval_status == 'approved' && $request->payment_status == 'done')
                                                                    <a href="{{ route('admin.commercial-requests.pdf.show', $request->id) }}" class="btn btn-success" target="_blank"><i class='bx bx-file'></i></a>
                                                                    @endif


                                                                    @if ($request->approval_status == 'rejected' && $request->payment_status == 'pending')
                                                                    <a href="{{ route('admin.commercial-requests.pdf.show', $request->id) }}" class="btn btn-danger" target="_blank"><i class='bx bx-file'></i></a>
                                                                    @endif

                                                                </div>

                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                                <!-- Pagination -->
                                                @if ($myRequests->hasPages())
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination justify-content-center mt-4 align-items-center">

                                                        <!-- Prev Button -->
                                                        <li class="page-item {{ $myRequests->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link btn btn-primary"
                                                                href="{{ $myRequests->previousPageUrl() }}">Prev</a>
                                                        </li>
                                                        &nbsp;

                                                        <!-- Page Input + Total -->
                                                        <li class="page-item d-flex align-items-center" style="margin: 0 2px;">
                                                            <form action="" method="GET" class="d-flex align-items-center" style="margin:0; padding:0;">
                                                                <input type="number" name="page"
                                                                    value="{{ $myRequests->currentPage() }}"
                                                                    min="1"
                                                                    max="{{ $myRequests->lastPage() }}"
                                                                    readonly
                                                                    class="form-control">
                                                                <input type="text"
                                                                    value="/ {{ $myRequests->lastPage() }}"
                                                                    readonly
                                                                    class="form-control">
                                                            </form>
                                                        </li>
                                                        &nbsp;

                                                        <!-- Next Button -->
                                                        <li class="page-item {{ !$myRequests->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link btn btn-primary"
                                                                href="{{ $myRequests->nextPageUrl() }}">Next</a>
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


                    <!-- Approve Modal -->
                    @foreach($myRequests as $request)
                    <div class="modal fade" id="approve{{ $request->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="approve" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" action="{{ route('admin.commercial-requests.approve', $request->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="approve">Approved Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure you want to <span class="text-success fw-bold">approve</span> this payment request?</h4>
                                    <p class="m-0 fw-bold fs-5">Requested amount: <span class="text-success">₹ {{ number_format($request->amount, 2) }}</span></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Approved</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach



                    <!-- Edit Amount Modal -->
                    @foreach($myRequests as $request)
                    <div class="modal fade" id="edit{{ $request->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="modal-content" id="editForm" action="{{ route('admin.my-request.amount.update', $request->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editLabel">Set Amount</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">

                                        <!-- Amount -->
                                        <div class="col-md-12 mb-3">
                                            <label for="edit_amount{{ $request->id }}" class="form-label">Requested Amount<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                id="edit_amount{{ $request->id }}"
                                                name="amount"
                                                value="{{ $request->amount }}">
                                        </div>

                                        <!-- Amount in Words -->
                                        <div class="col-md-12 mb-3">
                                            <label for="edit_amount_in_words{{ $request->id }}" class="form-label">Amount in Words</label>
                                            <!-- Hidden input -->
                                            <input type="hidden" id="edit_amount_in_words{{ $request->id }}"
                                                name="amount_in_words"
                                                value="{{ $request->amount_in_words }}">

                                            <!-- Visible preview -->
                                            <div id="edit_amountWords{{ $request->id }}"
                                                class="form-control bg-light"
                                                style="min-height: 40px; padding: .5rem;">
                                                {{ $request->amount_in_words ?? 'Amount will appear here...' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach



                    <!-- Reject Modal -->
                    @foreach($myRequests as $request)
                    <div class="modal fade" id="remark{{ $request->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="remark" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form class="modal-content" action="{{ route('admin.commercial-requests.reject', $request->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="remark">Give A Reason</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="reject_remarks" class="form-check-label mb-2">Give a reason why you want to <span class="text-danger fw-bold">reject</span> this payment request<span class="text-danger">*</span></label>
                                    <textarea name="reject_remarks" class="form-control" id="reject_remarks" rows="5" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Reject</button>
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

    <script>
        function numberToWords(num) {
            const a = [
                '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six',
                'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve',
                'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen',
                'Seventeen', 'Eighteen', 'Nineteen'
            ];
            const b = [
                '', '', 'Twenty', 'Thirty', 'Forty', 'Fifty',
                'Sixty', 'Seventy', 'Eighty', 'Ninety'
            ];

            function inWords(num) {
                if ((num = num.toString()).length > 9) return 'Overflow';
                let n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
                if (!n) return;
                let str = '';
                str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + ' Crore ' : '';
                str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + ' Lakh ' : '';
                str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + ' Thousand ' : '';
                str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + ' Hundred ' : '';
                str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
                return str.trim();
            }

            let parts = num.toString().split(".");
            let rupees = parseInt(parts[0]) || 0;
            let paise = parseInt(parts[1]) || 0;

            let words = '';
            if (rupees > 0) {
                words += inWords(rupees) + ' Rupees';
            }
            if (paise > 0) {
                words += (words ? ' and ' : '') + inWords(paise) + ' Paisa';
            }

            return words ? words + ' Only' : '';
        }

        // Update amount in words when typing
        document.getElementById("amount").addEventListener("input", function() {
            const amount = this.value;
            const amountWords = document.getElementById("amountWords");
            const wordsInput = document.getElementById("amount_in_words");

            if (amount && !isNaN(amount)) {
                let words = numberToWords(amount);
                amountWords.textContent = words;
                wordsInput.value = words; // also set in input field
            } else {
                amountWords.textContent = "Amount will appear here...";
                wordsInput.value = "";
            }
        });
    </script>



    <script>
        @foreach($myRequests as $request)
        document.getElementById("edit_amount{{ $request->id }}").addEventListener("input", function() {
            const amount = this.value;
            const amountWords = document.getElementById("edit_amountWords{{ $request->id }}");
            const wordsInput = document.getElementById("edit_amount_in_words{{ $request->id }}");

            if (amount && !isNaN(amount)) {
                let words = numberToWords(amount);
                amountWords.textContent = words;
                wordsInput.value = words;
            } else {
                amountWords.textContent = "Amount will appear here...";
                wordsInput.value = "";
            }
        });
        @endforeach
    </script>


</body>

</html>