<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Payment Approval Slip</title>
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
        }

        .content-table td {
            vertical-align: top;
            padding: 3px;
        }

        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
        }

        .checkbox-column {
            width: 50%;
            box-sizing: border-box;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .checkbox {
            width: 14px;
            height: 14px;
            border: 1px solid #000;
            margin-right: 5px;
            display: inline-block;
        }

        .checked {
            background-color: #000;
            position: relative;
        }

        .checked:after {
            content: "✓";
            color: white;
            font-size: 10px;
            position: absolute;
            top: 0;
            left: 2px;
        }

        .field {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .field-label {
            font-weight: bold;
            min-width: 120px;
        }

        .underline {
            border-bottom: 1px dotted #000;
            flex-grow: 1;
            min-height: 16px;
            margin-left: 5px;
            padding: 0 5px;
        }

        .amount-box {
            border: 1px solid #000;
            padding: 4px 8px;
            display: inline-block;
            min-width: 150px;
            min-height: 16px;
        }

        .divider {
            border-top: 1px solid #000;
            margin: 15px 0;
        }

        .bank-details {
            margin-top: 15px;
        }

        .bank-title {
            font-weight: bold;
            background: #f39c12;
            color: #fff;
            padding: 3px 6px;
            display: inline-block;
            margin-bottom: 5px;
            font-size: 11px;
        }

        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature-box {
            text-align: center;
            width: 30%;
        }

        .signature-label {
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 5px;
            margin-top: 40px;
        }

        .logo {
            height: 50px;
        }

        .date-field {
            text-align: right;
        }

        .checkbox-item {
            margin-bottom: 6px;
            font-family: DejaVu Sans, sans-serif;
            /* good for ✓ */
        }

        .checkbox-item input[type="checkbox"] {
            vertical-align: middle;
            /* aligns with text */
            margin-right: 6px;
            transform: scale(1.2);
            /* bigger box */
        }

        .checkbox-item span {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- Header --}}
        <table class="content-table">
            <tr>
                <td style="width: 60px;">
                    <img src="{{ public_path('img/RCPL.png') }}" class="logo" alt="Logo">
                </td>
                <td class="header">
                    <div class="company-name">RANIHATI CONSTRUCTION PRIVATE LIMITED</div>
                    <div class="document-title">Payment Approval Slip</div>
                </td>
                <td style="width: 120px; text-align: right;">
                    <div class="date-field" style="font-weight: bold; font-size: 12px;">Date: {{ $payment->date ? \Carbon\Carbon::parse($payment->date)->format('d-m-Y') : '' }}</div>
                </td>
            </tr>
        </table>

        {{-- Checkboxes --}}
        @php
        // Parse the request_for field to get selected options
        $selectedOptions = [];
        if (!empty($payment->request_for)) {
        if (is_string($payment->request_for)) {
        // Try to decode JSON if it's stored as JSON string
        $decoded = json_decode($payment->request_for, true);
        if (json_last_error() === JSON_ERROR_NONE) {
        $selectedOptions = $decoded;
        } else {
        // If it's not JSON, try to extract options from the string
        $text = $payment->request_for;
        $options = [
        'Material Purchase',
        'Material Due Payment',
        'Advance for Materials',
        'Tools & Machinery Purchase',
        'Labour Cont. Payment',
        'Labour Cont. Due Payment',
        'Advance for Tools',
        'Establish'
        ];

        foreach ($options as $option) {
        if (stripos($text, $option) !== false) {
        $selectedOptions[] = $option;
        }
        }
        }
        } elseif (is_array($payment->request_for)) {
        $selectedOptions = $payment->request_for;
        }
        }
        @endphp

        <table class="content-table">
            <tr>
                <td style="width: 50%;">
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Material Purchase', $selectedOptions) ? 'checked' : '' }}>
                        <span>Material Purchase</span>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Material Due Payment', $selectedOptions) ? 'checked' : '' }}>
                        <span>Material Due Payment</span>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Advance for Materials', $selectedOptions) ? 'checked' : '' }}>
                        <span>Advance for Materials</span>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Tools & Machinery Purchase', $selectedOptions) ? 'checked' : '' }}>
                        <span>Tools & Machinery Purchase</span>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Plant Machinery Rent', $selectedOptions) ? 'checked' : '' }}>
                        <span>Plant Machinery Rent</span>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Labour Cont. Payment', $selectedOptions) ? 'checked' : '' }}>
                        <span>Labour Cont. Payment</span>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Labour Cont. Due Payment', $selectedOptions) ? 'checked' : '' }}>
                        <span>Labour Cont. Due Payment</span>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Advance for Tools', $selectedOptions) ? 'checked' : '' }}>
                        <span>Advance for Tools</span>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" {{ in_array('Establish (room rent, cooking utensils)', $selectedOptions) ? 'checked' : '' }}>
                        <span>Establish (room rent, cooking utensils)</span>
                    </div>
                </td>
            </tr>

        </table>

        <br>

        {{-- Vendor Info --}}
        <table style="width:100%; border-collapse: collapse; margin-bottom:10px; font-size:12px;">
            <tr>
                <td style="width:180px;"><strong>Vendor Name:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->vendor_name ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Vendor Code:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->vendor_code ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Site Name:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->site_name ?? '' }}</td>
            </tr>
        </table>

        {{-- Amount --}}
        <table style="width:100%; border-collapse: collapse; margin-bottom:10px; font-size:12px;">
            <tr>
                <td style="width:180px;"><strong>Amount:</strong></td>
                <td style="border-bottom:1px dotted #000;"><strong>₹ {{ $payment->amount ? number_format($payment->amount, 2) : '' }}</strong></td>
            </tr>
            <tr>
                <td><strong>Amount in Words:</strong></td>
                <td style="border-bottom:1px dotted #000;"><strong>&nbsp; {{ $payment->amount_in_words ?? '' }}</strong></td>
            </tr>

            <tr>
                <td><strong>Remarks:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->remarks ?? '' }}</td>
            </tr>
        </table>

        {{-- Description --}}
        <table style="width:100%; border-collapse: collapse; margin-bottom:10px; font-size:12px;">
            <tr>
                <td style="width:180px;"><strong>Item Description:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->item_description ?? '' }}</td>
            </tr>
            <tr>
                <td></td>
                <td style="border-bottom:1px dotted #000;">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td style="border-bottom:1px dotted #000;">&nbsp;</td>
            </tr>
        </table>



        {{-- Bank Details --}}
        <div style="font-weight:bold; margin-bottom:5px;">Party Bank Details:</div>
        <table style="width:100%; border-collapse: collapse; font-size:12px;">
            <tr>
                <td style="width:180px;"><strong>Account No.:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->party_account_number ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>IFSC Code:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->party_ifsc_code ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Bank Name:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->party_bank_name ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Branch:</strong></td>
                <td style="border-bottom:1px dotted #000;">&nbsp; {{ $payment->party_bank_branch_name ?? '' }}</td>
            </tr>
        </table>

        {{-- Footer Signatures --}}
        <table style="width:100%; margin-top:50px; text-align:center; font-size:12px;">
            <tr>
                <td style="width:33%; color: green;">
                    
                    @if($payment->status == 'pending')
                    Approved By<br>
                    <span style="color: red;">Pending</span>
                    @elseif($payment->status == 'approved')
                    Approved By<br>
                    <span style="color: green;">Sekh Arif Hossain</span><span style="color: green;"> (MD)</span>
                    @elseif($payment->status == 'rejected')
                    Rejected By<br>
                    <span style="color: red;">Sekh Arif Hossain</span><span style="color: red;"> (MD)</span>
                    @elseif($payment->status == 'remarked')
                    Remarked By<br>
                    <span style="color: black;">Sekh Arif Hossain</span><span style="color: black;"> (MD)</span>
                    @endif
                    <br>
                    ___________________
                </td>
                <td style="width:33%;">
                    Accounts (after payment)<br>
                    @if($payment->status == 'pending')
                    <span style="color: red;">Pending</span>
                    @elseif($payment->status == 'approved')
                    <span style="color: green;">Sayek Ali Mallick</span><span style="color: green;"> (Senior Accountant)</span>
                    @elseif($payment->status == 'rejected')
                    <span style="color: red;">Sayek Ali Mallick</span><span style="color: red;"> (Senior Accountant)</span>
                    @elseif($payment->status == 'remarked')
                    <span style="color: black;">Sayek Ali Mallick</span><span style="color: black;"> (Senior Accountant)</span>
                    @endif
                    <br>
                    ___________________
                </td>
                <td style="width:33%;">
                    Requisition By<br>{{ $payment->user->name ?? '' }}<br>
                    ___________________
                </td>
            </tr>
        </table>

    </div>
</body>

</html>