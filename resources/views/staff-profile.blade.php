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
    <link rel="stylesheet" href="{{ asset('./css/style.css') }}" />

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
                                <a href="/staff/staff-payment-form" style="text-decoration: none;" class="btn btn-download">Approval Form</a>
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
                                                <th class="th">Approval Status</th>
                                                <th class="th">Payment Status</th>
                                                <th class="th">Date</th>
                                                <th class="th">Site Name</th>
                                                <th class="th">Request For</th>
                                                <th class="th">Amount</th>
                                                <th class="th">Vendor Details</th>
                                                <th class="th">Item Description</th>
                                                <th class="th">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($paymentRequestDetails as $payment)
                                            <tr>
                                                <td class="td">{{ $loop->iteration }}</td>
                                                <td class="td" style="display: flex; flex-direction: column; gap: 5px;">
                                                    <a href="{{ route('staff.payment.pdf', $payment->id) }}" class="btn btn-download" style="font-size: 12px;">
                                                        <i class="fas fa-download me-1"></i>
                                                    </a>
                                                    <a href="{{ route('stuff.stuff-payment-form.edit', $payment->id) }}" class="btn btn-update" style="font-size: 12px;">
                                                        <i class="fas fa-pencil me-1"></i>
                                                    </a>
                                                    <a href="{{ route('stuff.stuff-payment-form.delete', $payment->id) }}" class="btn btn-delete" style="font-size: 12px;">
                                                        <i class="fas fa-trash me-1"></i>
                                                    </a>
                                                </td>

                                                <td class="td">
                                                    @if($payment->status == 'pending')
                                                    <p class="btn btn-update" style="color: black;">Pending</p>
                                                    @elseif($payment->status == 'approved')
                                                    <p class="btn btn-download" style="color: white;">Approved</p>
                                                    @elseif($payment->status == 'rejected')
                                                    <p class="btn btn-delete" style="color: white;">Rejected</p>
                                                    @elseif($payment->status == 'remarked')
                                                    <p class="btn btn-status" style="color: white;">Remarked</p>
                                                    @endif
                                                </td>

                                                <td class="td">
                                                    @if($payment->payment_status == 'Pending')
                                                    <p class="btn btn-update" style="color: black;"><i class="fa-solid fa-clock-rotate-left"></i></p>
                                                    @elseif($payment->payment_status == 'Done')
                                                    <p class="btn btn-download" style="color: white;"><i class="fa-solid fa-circle-check"></i></p>
                                                    @endif
                                                </td>

                                                <td class="td"><strong>{{ $payment->date?->format('d M Y') }}</strong></td>
                                                <td class="td">{{ $payment->site_name }}</td>
                                                <td class="td">
                                                    @if(!empty($payment->request_for))
                                                    <ul style="padding-left: 16px; margin: 0;">
                                                        @foreach($payment->request_for as $req)
                                                        <li>{{ $req }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @else
                                                    <span>No Request Found</span>
                                                    @endif
                                                </td>

                                                <td class="td"><strong>₹ {{ number_format($payment->amount, 2) }}</strong></td>

                                                
                                                <td class="td">
                                                    <p class="m-0">{{ $payment->vendor_name }}</p>
                                                    <p class="m-0">Code: {{ $payment->vendor_code }}</p>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#desc{{ $payment->id }}" data-bs-backdrop="static">
                                                        View
                                                    </button>
                                                </td>

                                                <td class="td">
                                                    @if(!empty($payment->remarks))
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#remark{{ $payment->id }}" data-bs-backdrop="static">
                                                        Show
                                                    </button>
                                                    @else
                                                    <span>Not Found</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" class="text-center">No record found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>

                                @if ($paymentRequestDetails->hasPages())
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mt-4 align-items-center">

                                        <!-- {{-- Prev Button --}} -->
                                        <li class="page-item {{ $paymentRequestDetails->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $paymentRequestDetails->previousPageUrl() }}"
                                                style="font-size: 12px; height: 32px; padding: 4px 10px;">Prev</a>
                                        </li>

                                        <!-- {{-- Page Input + Total --}} -->
                                        <li class="page-item d-flex align-items-center" style="margin: 0 2px;">
                                            <form action="" method="GET" class="d-flex align-items-center" style="margin:0; padding:0;">
                                                <input type="number" name="page"
                                                    value="{{ $paymentRequestDetails->currentPage() }}"
                                                    min="1"
                                                    max="{{ $paymentRequestDetails->lastPage() }}"
                                                    readonly
                                                    class="form-control"
                                                    style="width: 50px; height: 32px; font-size: 12px; text-align: center; padding: 0; border-radius:0;">
                                                <input type="text"
                                                    value="/ {{ $paymentRequestDetails->lastPage() }}"
                                                    readonly
                                                    class="form-control"
                                                    style="width: 50px; height: 32px; font-size: 12px; text-align: center; padding: 0; margin-left:-1px; border-radius:0;">
                                            </form>
                                        </li>

                                        <!-- {{-- Next Button --}} -->
                                        <li class="page-item {{ !$paymentRequestDetails->hasMorePages() ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $paymentRequestDetails->nextPageUrl() }}"
                                                style="font-size: 12px; height: 32px; padding: 4px 10px;">Next</a>
                                        </li>

                                    </ul>
                                </nav>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-card">
                            <div class="payment-body">
                                <p style="text-align: right; width: 100%;">
                                <form action="{{ route('staff.logout') }}" method="POST" style="display:flex; justify-content: end;">
                                    @csrf
                                    <button type="submit" style="color: black; text-decoration: none; background:none; border:none;" class="mb-3">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                                </p>

                                <form id="profileForm" action="{{ route('staff.profile.update') }}" method="POST" class="mt-2">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="staffName" class="form-label">Staff Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control editable" name="name"
                                                value="{{ $user->name }}" readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="staffCode" class="form-label">Staff Code</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="text" class="form-control" value="{{ $user->staff_code }}" readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" value="{{ $user->email }}" readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel" class="form-control editable" name="mobile"
                                                value="{{ $user->mobile }}" readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control editable" name="password" readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control editable" name="password_confirmation" readonly />
                                        </div>
                                    </div>

                                    <button type="button" id="editBtn" class="btn btn-edit w-100">
                                        <i class="fas fa-edit me-2"></i>Edit Profile
                                    </button>

                                    <button type="submit" id="saveBtn" class="btn btn-success w-100 mt-2 d-none">
                                        <i class="fas fa-save me-2"></i>Save Changes
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        @foreach($paymentRequestDetails as $payment)
        <div class="modal fade" id="desc{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="desc" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="desc">Item Description</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ $payment->item_description }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Modal -->
        @foreach($paymentRequestDetails as $payment)
        <div class="modal fade" id="remark{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="desc" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="desc">Why request is rejected?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Your payment request has been rejected with the following remark: <strong style="color: red;">{{ $payment->remarks }}</strong>.
                        Please resubmit your request after further discussion.
                        Thank you for your understanding.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

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

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("editBtn").addEventListener("click", function() {
            let editableFields = document.querySelectorAll(".editable");
            editableFields.forEach(el => {
                el.removeAttribute("readonly");
            });

            document.getElementById("editBtn").classList.add("d-none");
            document.getElementById("saveBtn").classList.remove("d-none");
        });
    </script>
</body>

</html>