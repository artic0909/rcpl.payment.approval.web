<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Request</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            background-color: #f9f9f9;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .email-header {
            background-color: #1a3a5f;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .email-body {
            padding: 30px;
        }

        .field-group {
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .field-label {
            font-weight: 600;
            color: #1a3a5f;
            display: inline-block;
            width: 180px;
            vertical-align: top;
        }

        .field-value {
            display: inline-block;
            width: calc(100% - 200px);
        }

        .status-approved {
            color: #28a745;
            font-weight: 600;
        }

        .status-pending {
            color: #ffc107;
            font-weight: 600;
        }

        .status-rejected {
            color: #dc3545;
            font-weight: 600;
        }

        .amount-box {
            background-color: #f8f9fa;
            border-left: 4px solid #1a3a5f;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }

        .footer {
            background-color: #1a3a5f;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }

        .footer-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        .remarks-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Payment Request</h1>
            <p>Commercial Department</p>
        </div>

        <div class="email-body">
            <p>Dear Managing Director,</p>
            <p>I am writing to request approval for the following payment:</p>

            <div class="field-group">
                <span class="field-label">Date:</span>
                <span class="field-value">{{ \Carbon\Carbon::parse($commercialRequest->date)->format('F d, Y') }}</span>
            </div>

            <div class="field-group">
                <span class="field-label">Approval Status:</span>
                <span class="field-value status-pending">{{ ucfirst($commercialRequest->approval_status) }}</span>
            </div>

            <div class="field-group">
                <span class="field-label">Payment Status:</span>
                <span class="field-value">
                    @if($commercialRequest->payment_status === 'pending')
                    Awaiting Approval
                    @else
                    {{ ucfirst($commercialRequest->payment_status) }}
                    @endif
                </span>
            </div>

            <div class="field-group">
                <span class="field-label">Payment Type:</span>
                <span class="field-value">{{ $commercialRequest->payment_type }}</span>
            </div>

            <div class="field-group">
                <span class="field-label">Amount:</span>
                <span class="field-value">
                    <div class="amount-box">
                        <strong>₹{{ number_format($commercialRequest->amount, 2) }}</strong>
                        <div>{{ $commercialRequest->amount_in_words }}</div>
                    </div>
                </span>
            </div>

            <div class="field-group">
                <span class="field-label">Remarks:</span>
                <span class="field-value">
                    <div class="remarks-box">
                        {{ $commercialRequest->remarks ?? 'No remarks provided.' }}
                    </div>
                </span>
            </div>

            <p>Please review this request at your earliest convenience and provide your approval.</p>

            <p>Best regards,<br>
                <strong>Commercial Head</strong><br>
                Ranihat Construction PVT LTD
            </p>
        </div>

        <div class="footer">
            <p>© 2025 Ranihat Construction PVT LTD. All rights reserved.</p>
        </div>
    </div>

</body>

</html>