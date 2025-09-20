<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Payment Request Slip | RCPL</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('./img/rupee.png') }}" />
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 15px;
            color: #000;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #0a4dad;
            margin-bottom: 5px;
        }

        .document-title {
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 15px;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .content-table td {
            vertical-align: top;
            padding: 3px;
            border-bottom: 1px dotted #000;
        }

        .signature-box {
            text-align: center;
            width: 33%;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- Header --}}
        <table class="content-table">
            <tr>
                <td style="width: 60px;">
                    <img src="{{ asset('./img/RCPL.png') }}" style="height:50px;" alt="Logo">
                </td>
                <td class="header">
                    <div class="company-name">RANIHATI CONSTRUCTION PRIVATE LIMITED</div>
                    <div class="document-title">Payment Request Slip</div>
                </td>
                <td style="width: 120px; text-align: right;">
                    <strong>Date:</strong> {{ $payment->date ? $payment->date->format('d-m-Y') : '' }}
                </td>
            </tr>
        </table>

        {{-- Amount --}}
        <table class="content-table">
            <tr>
                <td style="width:180px;"><strong>Amount:</strong></td>
                <td><strong>₹ {{ $payment->amount ? number_format($payment->amount, 2) : '' }}</strong></td>
            </tr>
            <tr>
                <td><strong>Amount in Words:</strong></td>
                <td><strong>{{ $payment->amount_in_words ?? '' }}</strong></td>
            </tr>
            <tr>
                <td><strong>Payment Type:</strong></td>
                <td>{{ ucfirst($payment->payment_type ?? '') }}</td>
            </tr>
            <tr>
                <td><strong>Remarks:</strong></td>
                <td>{{ $payment->remarks ?? '' }}</td>
            </tr>
            @if($payment->approval_status == 'rejected')
            <tr>
                <td><strong>Reject Remarks:</strong></td>
                <td style="color:red;">{{ $payment->reject_remarks ?? '' }}</td>
            </tr>
            @endif
        </table>

        {{-- Status --}}
        <table class="content-table">
            <tr>
                <td style="width:180px;"><strong>Approval Status:</strong></td>
                <td>{{ ucfirst($payment->approval_status ?? '') }}</td>
            </tr>
            <tr>
                <td><strong>Payment Status:</strong></td>
                <td>{{ ucfirst($payment->payment_status ?? '') }}</td>
            </tr>
        </table>

        {{-- Signatures --}}
        <table style="width:100%; margin-top:40px; text-align:center; font-size:12px;">
            <tr>
                <td class="signature-box">
                    Approved By<br>
                    @if($payment->approval_status == 'approved')
                    <span style="color: green;">Sekh Arif Hossain (MD)</span>
                    @elseif($payment->approval_status == 'rejected')
                    <span style="color: red;">Rejected</span>
                    @else
                    <span style="color: orange;">Pending</span>
                    @endif
                    <br>___________________
                </td>
                <td class="signature-box">
                    Accounts (after payment)<br>
                    @if($payment->payment_status == 'done')
                    <span style="color: green;">Sayek Ali Mallick (Commercial Head)</span>
                    @else
                    <span style="color: red;">Pending</span>
                    @endif
                    <br>___________________
                </td>
                <td class="signature-box">
                    Requisition By<br>Commercial Head<br>
                    ___________________
                </td>
            </tr>
        </table>
    </div>
</body>

</html>