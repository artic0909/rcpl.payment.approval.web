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

                            <a href="/stuff/stuff-profile" style="width: fit-content;">
                                <img src="{{ asset('./img/user.png') }}" alt="Profile" class="profile-img" />
                            </a>
                        </div>

                    </div>

                    <div class="payment-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="secure-badge">
                                    <i class="fas fa-shield-alt me-2"></i>Secure Transaction
                                </div>
                                <h4 class="mb-4">Payment Approval Slip</h4>

                                <form>
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                                <input
                                                    type="date"
                                                    class="form-control"
                                                    id="date"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="checkbox-group">
                                                <h5 class="mb-3">Material Payments</h5>
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="materialPurchase" />
                                                    <label
                                                        class="form-check-label"
                                                        for="materialPurchase">Material Purchase</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="materialDuePayment" />
                                                    <label
                                                        class="form-check-label"
                                                        for="materialDuePayment">Material Due Payment</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="advanceMaterials" />
                                                    <label
                                                        class="form-check-label"
                                                        for="advanceMaterials">Advance for Materials</label>
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="toolsPurchase" />
                                                    <label class="form-check-label" for="toolsPurchase">Tools & Machinery Purchase</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox-group">
                                                <h5 class="mb-3">Labor & Other Payments</h5>
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="labourPayment" />
                                                    <label class="form-check-label" for="labourPayment">Labour Cont. Payment</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="labourDuePayment" />
                                                    <label
                                                        class="form-check-label"
                                                        for="labourDuePayment">Labour Cont. Due Payment</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="advanceTools" />
                                                    <label class="form-check-label" for="advanceTools">Advance for Tools</label>
                                                </div>
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        id="establishment" />
                                                    <label class="form-check-label" for="establishment">Establish (room rent, cooking utensils)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vendorName" class="form-label">Vendor Name
                                                    <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="vendorName"
                                                    placeholder="Enter vendor name"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vendorCode" class="form-label">Vendor Code
                                                    <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="vendorCode"
                                                    placeholder="Enter vendor code"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="siteName" class="form-label">Site Name <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="siteName"
                                                    placeholder="Enter site name"
                                                    required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount" class="form-label">Amount (₹)
                                                    <span class="text-danger">*</span></label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    id="amount"
                                                    placeholder="Enter amount"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="form-label">Amount in Words</label>
                                            <div class="amount-in-words" id="amountWords">
                                                Amount will appear here...
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="itemDescription" class="form-label">Item Description
                                            <span class="text-danger">*</span></label>
                                        <textarea
                                            class="form-control"
                                            id="itemDescription"
                                            rows="3"
                                            placeholder="Enter item description"
                                            required></textarea>
                                    </div>

                                    <h4 class="mb-3">Party Bank Details</h4>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="accountNumber" class="form-label">Account Number
                                                    <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="accountNumber"
                                                    placeholder="Enter account number"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ifscCode" class="form-label">IFSC Code <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="ifscCode"
                                                    placeholder="Enter IFSC code"
                                                    required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bankName" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="bankName"
                                                    placeholder="Enter bank name"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="branch" class="form-label">Branch <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="branch"
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

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to convert numbers to words
        function numberToWords(number) {
            const units = [
                "",
                "One",
                "Two",
                "Three",
                "Four",
                "Five",
                "Six",
                "Seven",
                "Eight",
                "Nine",
            ];
            const teens = [
                "Ten",
                "Eleven",
                "Twelve",
                "Thirteen",
                "Fourteen",
                "Fifteen",
                "Sixteen",
                "Seventeen",
                "Eighteen",
                "Nineteen",
            ];
            const tens = [
                "",
                "Ten",
                "Twenty",
                "Thirty",
                "Forty",
                "Fifty",
                "Sixty",
                "Seventy",
                "Eighty",
                "Ninety",
            ];

            if (number === 0) return "Zero";

            let words = "";

            // Handle lakhs
            if (number >= 100000) {
                words += numberToWords(Math.floor(number / 100000)) + " Lakh ";
                number %= 100000;
            }

            // Handle thousands
            if (number >= 1000) {
                words += numberToWords(Math.floor(number / 1000)) + " Thousand ";
                number %= 1000;
            }

            // Handle hundreds
            if (number >= 100) {
                words += units[Math.floor(number / 100)] + " Hundred ";
                number %= 100;
            }

            // Handle tens and units
            if (number > 0) {
                if (number < 10) {
                    words += units[number];
                } else if (number < 20) {
                    words += teens[number - 10];
                } else {
                    words += tens[Math.floor(number / 10)];
                    if (number % 10 > 0) {
                        words += " " + units[number % 10];
                    }
                }
            }

            return words.trim() + " Rupees Only";
        }

        // Update amount in words when amount changes
        document.getElementById("amount").addEventListener("input", function() {
            const amount = parseFloat(this.value);
            const amountWords = document.getElementById("amountWords");

            if (!isNaN(amount) && amount >= 0) {
                amountWords.textContent = numberToWords(amount);
            } else {
                amountWords.textContent = "Amount will appear here...";
            }
        });
    </script>
</body>

</html>