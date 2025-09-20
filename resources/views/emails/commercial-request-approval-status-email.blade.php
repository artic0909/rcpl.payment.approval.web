<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Request {{ ucfirst($request->approval_status) }}</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
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

        .approval-banner {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .rejected-banner {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
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
        <!-- {{-- Banner --}} -->
        @if($request->approval_status === 'approved')
        <div class="approval-banner">
            PAYMENT REQUEST APPROVED
            <p>From the Managing Director</p>

        </div>
        @elseif($request->approval_status === 'rejected')
        <div class="rejected-banner">
            PAYMENT REQUEST REJECTED
            <p>From the Managing Director</p>

        </div>
        @endif
        <!-- 
        <div class="email-header">
            <h1>Payment Request {{ ucfirst($request->approval_status) }}</h1>
            <p>From the Managing Director</p>
        </div> -->

        <div class="email-body">
            <p>Dear Commercial Team,</p>

            @if($request->approval_status === 'approved')
            <p>I have reviewed and approved the following payment request:</p>
            @else
            <p>After reviewing, I regret to inform you that the following payment request has been rejected:</p>
            @endif

            <div class="field-group">
                <span class="field-label">Date:</span>
                <span class="field-value">{{ $request->created_at->format('F d, Y') }}</span>
            </div>

            <!-- <div class="field-group">
                <span class="field-label">Payment Status:</span>
                <span class="field-value 
              {{ $request->payment_status === 'approved' ? 'status-approved' : 
                 ($request->payment_status === 'rejected' ? 'status-rejected' : 'status-pending') }}">
                    {{ ucfirst($request->payment_status) }}
                </span>
            </div> -->

            <div class="field-group">
                <span class="field-label">Payment Type:</span>
                <span class="field-value">{{ $request->payment_type }}</span>
            </div>

            <div class="field-group">
                <span class="field-label">Amount:</span>
                <span class="field-value">
                    <div class="amount-box">
                        <strong>₹{{ number_format($request->amount, 2) }}</strong>
                        <div>{{ $request->amount_in_words }}</div>
                    </div>
                </span>
            </div>

            <div class="field-group">
                <span class="field-label">Remarks:</span>
                <span class="field-value">
                    <div class="remarks-box">
                        {{ $request->remarks ?? 'No remarks provided' }}
                    </div>
                </span>
            </div>

            <div class="field-group">
                <span class="field-label">Rejection Remarks:</span>
                <span class="field-value">
                    <div class="remarks-box">
                        @if($request->approval_status === 'rejected')
                        {{ $request->rejection_remarks ?? 'No remarks provided' }}
                        @else
                        <em>Not applicable - Request Approved</em>
                        @endif
                    </div>
                </span>
            </div>

            @if($request->approval_status === 'approved')
            <p>Please proceed with the payment processing according to company procedures.</p>
            @else
            <p>This payment request will not be processed. Kindly review and resubmit if necessary.</p>
            @endif

            <p>
                Best regards,<br />
                <strong>Managing Director</strong><br />
                Ranihat Construction PVT LTD
            </p>
        </div>

        <div class="footer">
            <p>© {{ now()->year }} Ranihat Construction PVT LTD. All rights reserved.</p>
        </div>
    </div>
</body>

</html>