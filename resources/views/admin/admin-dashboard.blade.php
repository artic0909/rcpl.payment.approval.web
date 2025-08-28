<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
</head>

<body style="margin: 50px;">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-3">All Payments Requests</h1>
        <div>
            <a href="{{ route('export.payment.requests') }}"
                style="font-size: 20px; color:#007bff;">
                Export
            </a>

            &nbsp;
            &nbsp;
            &nbsp;

            <a href="{{ route('admin.logout') }}"
                style="font-size: 20px; color:#007bff;">
                Logout
            </a>
        </div>

    </div>
    <table class="table table-hover table-responsive table-bordered">
        <thead>
            <tr>
                <th class="th">SL.</th>
                <th class="th">Action</th>
                <th class="th">Date</th>
                <th class="th">Request For</th>
                <th class="th">Amount</th>
                <th class="th">Vendor Details</th>
                <th class="th">Staff Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paymentRequestDetails as $payment)
            <tr>
                <td class="td">{{ $loop->iteration }}</td>
                <td class="td">
                    <a href="{{ route('admin.payment.pdf', $payment->id) }}" class="btn btn-primary" style="font-size: 12px;">PDF</a>
                </td>
                <td class="td">{{ $payment->date?->format('d M Y') }}</td>
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

                <td class="td">₹ {{ number_format($payment->amount, 2) }}</td>
                <td class="td">
                    <p class="m-0">Vendor Name: {{ $payment->vendor_name }}</p>
                    <p class="m-0">Code: {{ $payment->vendor_code }}</p>
                </td>

                <td class="td">
                    <p class="m-0">Name: {{ $payment->user->name }}</p>
                    <p class="m-0">Code: {{ $payment->user->staff_code }}</p>
                    <p class="m-0">Email: {{ $payment->user->email }}</p>
                    <p class="m-0">Mobile: {{ $payment->user->mobile }}</p>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No record found</td>
            </tr>
            @endforelse
        </tbody>

    </table>
</body>

</html>