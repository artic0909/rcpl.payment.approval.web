<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Approval Form | RCPL</title>
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
    <link rel="stylesheet" href="{{ asset('./css/payment-approval-form.css') }}" />
    <link rel="stylesheet" href="{{ asset('./css/style.css') }}" />

    <!-- favicon -->
    <link rel="icon" href="{{ asset('./img/RCPL.png') }}" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="payment-card">
                    <div class="payment-header">
                        <div class="d-flex justify-content-between align-items-center responsive-head">
                            <div class="">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img
                                        src="{{ asset('./img/RCPL.png') }}"
                                        alt="RCPL LOGO"
                                        class="bank-logo" />
                                    <h2>Secure Payment Portal</h2>
                                </div>
                                <p class="mb-0 mt-2">
                                    Authorized payments only. All transactions require approval.
                                </p>
                            </div>

                            <a href="/staff/staff-profile" style="width: fit-content;">
                                <img src="{{ asset('./img/user.png') }}" alt="Profile" class="profile-img" />
                            </a>
                        </div>

                    </div>

                    <div class="payment-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="secure-badge" style="font-size: 15px; text-transform: capitalize;">
                                    <i class="fas fa-user me-2"></i>Name: {{ $user->name }} &nbsp;<i class="fas fa-shield-alt"></i> Code: {{ $user->staff_code }}
                                </div>
                                <h4 class="mb-4">Payment Approval Slip</h4>

                                <form method="POST" action="{{ route('staff.staff-payment-form.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="date"
                                                    name="date"
                                                    required />

                                                <input
                                                    type="hidden"
                                                    class="form-control"
                                                    id="user_id"
                                                    name="user_id"
                                                    value="{{ Auth::id() }}"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="checkbox-group">
                                                <h5 class="mb-3">Material Payments</h5>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Material Purchase" id="materialPurchase">
                                                    <label class="form-check-label" for="materialPurchase">Material Purchase</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Material Due Payment" id="materialDuePayment">
                                                    <label class="form-check-label" for="materialDuePayment">Material Due Payment</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Advance for Materials" id="advanceMaterials">
                                                    <label class="form-check-label" for="advanceMaterials">Advance for Materials</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Tools & Machinery Purchase" id="toolsPurchase">
                                                    <label class="form-check-label" for="toolsPurchase">Tools & Machinery Purchase</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Plant Machinery Rent" id="plantMachineryRent">
                                                    <label class="form-check-label" for="plantMachineryRent">Plant Machinery Rent</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkbox-group">
                                                <h5 class="mb-3">Labor & Other Payments</h5>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Labour Cont. Payment" id="labourPayment">
                                                    <label class="form-check-label" for="labourPayment">Labour Cont. Payment</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Labour Cont. Due Payment" id="labourDuePayment">
                                                    <label class="form-check-label" for="labourDuePayment">Labour Cont. Due Payment</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Advance for Tools" id="advanceTools">
                                                    <label class="form-check-label" for="advanceTools">Advance for Tools</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="request_for[]" value="Establish (room rent, cooking utensils)" id="establishment">
                                                    <label class="form-check-label" for="establishment">Establish (room rent, cooking utensils)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mb-4">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vendor_code" class="form-label">Vendor Code
                                                    <span class="text-danger">*</span></label>

                                                <select name="vendor_code" id="vendor_code" class="form-select" required>
                                                    <option value="" selected>Select Vendor Code</option>
                                                    @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->vendor_code }}">{{ $vendor->vendor_code }} - {{ $vendor->vendor_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vendor_name" class="form-label">Vendor Name
                                                    <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="vendor_name"
                                                    name="vendor_name"
                                                    placeholder="Enter vendor name"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="site_name"
                                                    name="site_name"
                                                    placeholder="Enter site name"
                                                    required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount" class="form-label">Amount (₹)
                                                    <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="amount"
                                                    name="amount"
                                                    placeholder="Enter amount"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="form-label" for="amount_in_words">Amount in Words
                                                <span class="text-danger">*</span></label>
                                            <div class="amount-in-words" id="amountWords">
                                                Amount will appear here...
                                            </div>
                                            <input type="hidden" class="form-control" id="amount_in_words" name="amount_in_words" placeholder="Enter amount in words" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="item_description" class="form-label">Item Description</label>
                                        <textarea
                                            class="form-control"
                                            id="item_description"
                                            name="item_description"
                                            rows="3"
                                            placeholder="Enter item description"
                                            required></textarea>
                                    </div>

                                    <h4 class="mb-3">Party Bank Details</h4>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="party_account_number" class="form-label">Account Number
                                                    <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="party_account_number"
                                                    name="party_account_number"
                                                    placeholder="Enter account number"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="party_ifsc_code" class="form-label">IFSC Code <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="party_ifsc_code"
                                                    name="party_ifsc_code"
                                                    placeholder="Enter IFSC code"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="party_bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="party_bank_name"
                                                    name="party_bank_name"
                                                    placeholder="Enter bank name"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="party_bank_branch_name" class="form-label">Branch <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="party_bank_branch_name"
                                                    name="party_bank_branch_name"
                                                    placeholder="Enter branch"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-submit w-100 mb-3">
                                        <i class="fas fa-check-circle me-2"></i>Submit for
                                        Approval
                                    </button>
                                </form>
                            </div>

                            <div class="col-lg-4">
                                <div class="payment-features">
                                    <h4 class="mb-4">Approval Process</h4>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-list-check"></i>
                                        </div>
                                        <div>
                                            <h5>Verification</h5>
                                            <p class="mb-0">
                                                All payments are verified against purchase orders
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-scale-balanced"></i>
                                        </div>
                                        <div>
                                            <h5>Approval Workflow</h5>
                                            <p class="mb-0">
                                                Multi-level approval based on amount thresholds
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div>
                                            <h5>Processing Time</h5>
                                            <p class="mb-0">
                                                Payments processed within 2-3 business days after
                                                approval
                                            </p>
                                        </div>
                                    </div>

                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fas fa-receipt"></i>
                                        </div>
                                        <div>
                                            <h5>Documentation</h5>
                                            <p class="mb-0">
                                                All payments require supporting documentation
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4 p-3 bg-white rounded-2">
                                        <h5>
                                            <i class="fas fa-info-circle text-primary me-2"></i>Important Notes
                                        </h5>
                                        <ul class="small mb-0 ps-3">
                                            <li>
                                                Complete all required fields marked with asterisk (*)
                                            </li>
                                            <li>Attach supporting documents before submission</li>
                                            <li>
                                                Double-check bank details to avoid payment errors
                                            </li>
                                            <li>Keep your payment reference number for tracking</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
        document.addEventListener('DOMContentLoaded', function() {
            const successPopup = document.getElementById('successPopup');
            const errorPopup = document.getElementById('errorPopup');

            if (successPopup) setTimeout(() => successPopup.remove(), 4000);
            if (errorPopup) setTimeout(() => errorPopup.remove(), 4000);
        });
    </script>

    <script>
        document.getElementById('vendor_code').addEventListener('change', function() {
            let vendorCode = this.value;
            if (vendorCode) {
                fetch(`/staff/get-vendor-details/${vendorCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('vendor_name').value = data.data.vendor_name;
                            document.getElementById('party_account_number').value = data.data.vendor_account_number;
                            document.getElementById('party_ifsc_code').value = data.data.vendor_ifsc_code;
                            document.getElementById('party_bank_name').value = data.data.vendor_bank_name;
                            document.getElementById('party_bank_branch_name').value = data.data.vendor_bank_branch_name;
                        } else {
                            alert('Vendor details not found');
                        }
                    })
                    .catch(err => console.error(err));
            }
        });
    </script>


</body>

</html>