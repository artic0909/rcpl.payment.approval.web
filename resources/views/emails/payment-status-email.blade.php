<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status Notification</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .email-container {
            max-width: 700px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #1a3a4a, #2c6e8c);
            color: white;
            padding: 25px 30px;
            text-align: center;
        }

        .logo-container {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-bottom: 15px !important;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: bold;
            color: #1a3a4a;
            font-size: 20px;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
        }

        .status-badge {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            margin: 15px 0 10px;
            font-size: 18px;
        }

        .status-approved {
            background-color: #4CAF50;
        }

        .status-rejected {
            background-color: #F44336;
        }

        .status-remarks {
            background-color: #2196F3;
            /* blue */
        }

        .approver {
            font-size: 14px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .email-body {
            padding: 30px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            color: #1a3a4a;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #eaeaea;
        }

        .payment-items {
            list-style-type: none;
            padding-left: 10px;
        }

        .payment-items li {
            padding: 8px 0;
            border-bottom: 1px dashed #eaeaea;
        }

        .payment-items li:last-child {
            border-bottom: none;
        }

        .detail-row {
            display: flex;
            margin-bottom: 12px;
        }

        .detail-label {
            flex: 1;
            font-weight: 600;
            color: #555;
        }

        .detail-value {
            flex: 2;
            color: #333;
        }

        .bank-details {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #2c6e8c;
        }

        .amount {
            font-size: 22px;
            font-weight: bold;
            color: #1a3a4a;
            margin: 10px 0;
        }

        .amount-in-words {
            font-style: italic;
            color: #666;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
        }

        .email-footer {
            background: #1a3a4a;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        .footer-logo {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-bottom: 15px !important;
        }

        .footer-logo-circle {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
            color: #1a3a4a;
        }

        .copyright {
            margin-top: 10px;
            opacity: 0.8;
        }

        @media (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .detail-row {
                flex-direction: column;
                margin-bottom: 15px;
            }

            .detail-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            {{-- Dynamic Status Badge --}}
            @if($payment_status == 'Done')
            <div class="status-badge status-approved">Done</div>
            @elseif($payment_status == 'Pending')
            <div class="status-badge status-remarks">Pending</div>
            @endif

            <div class="approver">- Sayek Ali Mallick (Commercial Head)</div>
        </div>

        <div class="email-body">
            <div class="section">
                <h3>Hello <strong>{{ $payment->user->name ?? 'User' }}</strong>,
                    your payment request has been <strong>{{ ucfirst($status) }}</strong>.</h3>
            </div>

            <div class="section">
                <h3 class="section-title">Your payment request for:</h3>
                <ul class="payment-items">
                    @foreach($payment->request_for as $index => $req)
                    <li>{{ $index+1 }}. {{ $req }}</li>
                    @endforeach

                </ul>
            </div>

            <div class="section">
                <h3 class="section-title">Item Description:</h3>
                <p>{{ $payment->item_description }}</p>
            </div>

            <div class="section">
                <h3 class="section-title">Payment Details</h3>
                <div class="amount">₹ {{ number_format($payment->amount, 2) }}</div>
                <div class="amount-in-words">{{ $payment->amount_in_words }}</div>

                @if($status == 'remarked')
                <div class="detail-row">
                    <div class="detail-label">Remarks :</div>
                    <div class="detail-value">{{ $payment->remarks ?? 'N/A' }}</div>
                </div>
                @endif

                <div class="detail-row">
                    <div class="detail-label">Site Name:</div>
                    <div class="detail-value">{{ $payment->site_name }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Vendor Name:</div>
                    <div class="detail-value">{{ $payment->vendor_name }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Vendor Code:</div>
                    <div class="detail-value">{{ $payment->vendor_code }}</div>
                </div>
            </div>

            <div class="section">
                <h3 class="section-title">Party Bank Details</h3>
                <div class="bank-details">
                    <div class="detail-row">
                        <div class="detail-label">Account No.:</div>
                        <div class="detail-value">{{ $payment->party_account_number }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">IFSC Code:</div>
                        <div class="detail-value">{{ $payment->party_ifsc_code }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Bank Name:</div>
                        <div class="detail-value">{{ $payment->party_bank_name }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Branch:</div>
                        <div class="detail-value">{{ $payment->party_bank_branch_name }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="email-footer">
            <div class="copyright">© {{ date('Y') }} Ranihati Construction PVT LTD. All rights reserved.</div>
        </div>
    </div>
</body>

</html>