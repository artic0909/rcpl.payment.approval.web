<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment History | User Profile | RCPL</title>
    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('./css/profile.css') }}" />

    <!-- favicon -->
    <link rel="icon" href="{{ asset('./img/RCPL.png') }}" />
</head>

<body>
    <div class="container">
        <!-- Profile Header -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="payment-card">
                    <div class="payment-header">
                        <div class="d-flex justify-content-between align-items-center responsive-head">
                            <div class="">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img
                                        src="{{ asset('./img/RCPL.png') }}"
                                        alt="RCPL LOGO"
                                        class="bank-logo" />
                                    <h2>RCPL Payment Approval</h2>
                                </div>
                                <p class="mb-0 mt-2">
                                    Authorized payments only. All transactions require approval.
                                </p>
                            </div>

                            <div>
                                <a href="/stuff/stuff-payment-form" style="text-decoration: none;" class="btn btn-download">Approval Form</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Payment History -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-card">
                            <div class="payment-body">
                                <h5 class="mb-4">
                                    <i class="fas fa-history me-2"></i>Payment Request History
                                </h5>

                                <div class="" style="overflow: auto;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="th">SL.</th>
                                                <th class="th">Action</th>
                                                <th class="th">Date</th>
                                                <th class="th">Request For</th>
                                                <th class="th">Amount</th>
                                                <th class="th">Vendor Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="td">1</td>
                                                <td class="td">
                                                    <button class="btn btn-download" style="font-size: 12px;">
                                                        <i class="fas fa-download me-1"></i> PDF
                                                    </button>
                                                </td>
                                                <td class="td">12 Oct 2023</td>
                                                <td class="td">Material Purchase</td>
                                                <td class="td">₹ 1,250.00</td>
                                                <td class="td">
                                                    <p class="m-0">ABC Suppliers</p>
                                                    <p class="m-0">Code: VS12</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mt-4">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" style="font-size: 12px;" tabindex="-1">
                                                << </a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#" style="font-size: 12px;">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" style="font-size: 12px;">...</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" style="font-size: 12px;">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" style="font-size: 12px;">>></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-card">
                            <div class="payment-body">
                                <p style="text-align: right; width: 100%;"><a href="" style="color: black; text-decoration: none;" class="mb-3"><i class="fas fa-sign-out-alt"></i> Logout</a></p>
                                <form id="profileForm" class="mt-2">
                                    <div class="mb-3">
                                        <label for="staffName" class="form-label">Staff Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="staffName"
                                                value="John Doe"
                                                readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="staffCode" class="form-label">Staff Code</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="staffCode"
                                                value="FIN2023-001"
                                                readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input
                                                type="email"
                                                class="form-control"
                                                id="email"
                                                value="john.doe@example.com"
                                                readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input
                                                type="tel"
                                                class="form-control"
                                                id="phone"
                                                value="+1 (555) 123-4567"
                                                readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="department"
                                                value="Finance"
                                                readonly />
                                        </div>
                                    </div>

                                    <button
                                        type="button"
                                        id="editBtn"
                                        class="btn btn-edit w-100">
                                        <i class="fas fa-edit me-2"></i>Edit Profile
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="payment-footer">
                    <p>
                        © 2025 Ranihati Construction PVT LTD. All rights reserved. Various
                        trademarks held by their respective owners.
                    </p>
                    <div class="bank-logos">
                        <i class="fab fa-cc-visa fa-2x bank-logo"></i>
                        <i class="fab fa-cc-mastercard fa-2x bank-logo"></i>
                        <i class="fab fa-cc-amex fa-2x bank-logo"></i>
                        <i class="fab fa-cc-paypal fa-2x bank-logo"></i>
                        <i class="fab fa-cc-apple-pay fa-2x bank-logo"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>