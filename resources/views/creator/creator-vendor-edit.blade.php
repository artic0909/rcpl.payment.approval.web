<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{$vendor-> vendor_name}} | Edit Vendor</title>

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
                    <li class="menu-item">
                        <a href="{{ route('creator.site-code-create') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx  bx-building-house'></i>
                            <div data-i18n="Classewes">Add Site Code</div>
                        </a>
                    </li>

                    <!-- Cards -->
                    <li class="menu-item active">
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


                            <form method="GET" action="{{ route('creator.vendor-create') }}" class="nav-item d-flex align-items-center">
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
                                <a href="{{ route('creator.vendor-create') }}" class="btn btn-secondary">Reset</a>
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

                    @php
                    $categories = ['Product sales', 'Service sales', 'Tools & machinary sales', 'Rent - plant & machine', 'Miscellaneous'];
                    @endphp

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <form class="row" action="{{ route('creator.vendor-create.update', $vendor->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <h4>Edit Vendor</h4>
                            <!-- State Code Dropdown -->
                            <div class="col-md-6 mb-3">
                                <label for="state_code" class="form-label">Choose Site Code</label>
                                <select class="form-select" id="state_code" name="state_code" style="text-transform: uppercase;">
                                    <!-- <option value="{{ $vendor->state_code }}" selected>{{ $vendor->state_code }}</option> -->
                                    @foreach($sites as $site)
                                    <option value="{{ $site->site_code }}" {{ $vendor->state_code == $site->site_code ? 'selected' : '' }}>
                                        {{ $site->site_code }} - {{ $site->site_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Vendor Name -->
                            <div class="col-md-6 mb-3">
                                <label for="vendor_name" class="form-label">Vendor Name</label>
                                <input type="text" class="form-control" id="vendor_name" name="vendor_name" value="{{ $vendor->vendor_name }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="vendor_code" class="form-label">Vendor Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="vendor_code" name="vendor_code"
                                        value="{{ $vendor->vendor_code }}" style="text-transform: uppercase;">
                                    <button type="button" class="btn btn-primary generateCodeBtn" data-target="vendor_code">
                                        Generate
                                    </button>
                                </div>
                            </div>


                            <!-- Vendor Category -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label d-block">Vendor Category</label>
                                @php
                                $savedCategories = is_string($vendor->vendor_category)
                                ? json_decode($vendor->vendor_category, true)
                                : $vendor->vendor_category;
                                @endphp

                                @foreach($categories as $category)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox"
                                        name="vendor_category[]"
                                        value="{{ $category }}"
                                        {{ is_array($savedCategories) && in_array($category, $savedCategories) ? 'checked' : '' }}>
                                    {{ $category }}
                                </div>
                                @endforeach

                            </div>

                            <!-- Optional fields -->
                            <div class="col-md-6 mb-3">
                                <label for="vendor_address" class="form-label">Vendor Address</label>
                                <input type="text" class="form-control" id="vendor_address" name="vendor_address" value="{{ $vendor->vendor_address }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vendor_account_number" class="form-label">Vendor Account Number</label>
                                <input type="text" class="form-control" id="vendor_account_number" name="vendor_account_number" value="{{ $vendor->vendor_account_number }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vendor_ifsc_code" class="form-label">Vendor IFSC Code</label>
                                <input type="text" class="form-control" id="vendor_ifsc_code" name="vendor_ifsc_code" value="{{ $vendor->vendor_ifsc_code }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vendor_bank_name" class="form-label">Vendor Bank Name</label>
                                <input type="text" class="form-control" id="vendor_bank_name" name="vendor_bank_name" value="{{ $vendor->vendor_bank_name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vendor_bank_branch_name" class="form-label">Vendor Bank Branch</label>
                                <input type="text" class="form-control" id="vendor_bank_branch_name" name="vendor_bank_branch_name" value="{{ $vendor->vendor_bank_branch_name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_person_name" class="form-label">Contact Person Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" value="{{ $vendor->contact_person_name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_person_mobile" class="form-label">Contact Person Mobile<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact_person_mobile" name="contact_person_mobile" value="{{ $vendor->contact_person_mobile }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_person_email" class="form-label">Contact Person Email</label>
                                <input type="email" class="form-control" id="contact_person_email" name="contact_person_email" value="{{ $vendor->contact_person_email }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="related_product_service" class="form-label">Related Product/Service</label>
                                <input type="text" class="form-control" id="related_product_service" name="related_product_service" value="{{ $vendor->related_product_service }}">
                            </div>

                            <div class="d-flex justify-content-center mt-2">
                                <button class="btn btn-primary w-50" type="submit">Update</button>
                            </div>
                        </form>
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

    <!-- JS for Vendor Code -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Edit modals generator
            document.querySelectorAll(".generateCodeBtn").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    const targetId = this.dataset.target;
                    const vendorId = targetId.replace("vendor_code", "");

                    const stateCode = document.getElementById("state_code" + vendorId).value;
                    const vendorName = document.getElementById("vendor_name" + vendorId).value.trim();

                    if (!stateCode || !vendorName) {
                        alert("Please select state & enter vendor name first!");
                        return;
                    }

                    const firstFour = vendorName.substring(0, 4).toLowerCase().replace(/\s+/g, '');
                    const now = new Date();
                    const month = String(now.getMonth() + 1).padStart(2, '0');
                    const year = String(now.getFullYear()).slice(-2);

                    const code = `${firstFour}-${stateCode}-${month}${year}`;
                    document.getElementById(targetId).value = code;
                });
            });
        });
    </script>


</body>

</html>