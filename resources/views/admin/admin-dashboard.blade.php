<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js">
    </script>
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
                <th class="th">PDF</th>
                <th class="th">Action</th>
                <th class="th">Status</th>
                <th class="th">Date</th>
                <th class="th">Request For</th>
                <th class="th">Item Description</th>
                <th class="th">Amount</th>
                <th class="th">Remarks</th>
                <th class="th">Vendor Details</th>
                <th class="th">Staff Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paymentRequestDetails as $payment)
            <tr>
                <td class="td">{{ $loop->iteration }}</td>
                <td class="td">
                    <a href="{{ route('admin.payment.pdf', $payment->id) }}" class="btn btn-primary">PDF</a>
                </td>

                <td class="td d-flex flex-column gap-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#remark{{ $payment->id }}" data-bs-backdrop="static">
                        Remark
                    </button>



                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#approve{{ $payment->id }}" data-bs-backdrop="static">
                        Approved
                    </button>



                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject{{ $payment->id }}" data-bs-backdrop="static">
                        Rejected
                    </button>


                </td>

                <td class="td">
                    @if($payment->status == 'pending')
                    <span class="badge rounded-border bg-warning text-dark p-3">Pending</span>
                    @elseif($payment->status == 'approved')
                    <span class="badge rounded-border bg-success p-3">Approved</span>
                    @elseif($payment->status == 'rejected')
                    <span class="badge rounded-border bg-danger p-3">Rejected</span>
                    @elseif($payment->status == 'remarked')
                    <span class="badge rounded-border bg-primary p-3">Remarked</span>
                    @endif
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

                <td class="td">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#desc{{ $payment->id }}" data-bs-backdrop="static">
                        View
                    </button>
                </td>




                <td class="td">₹ {{ number_format($payment->amount, 2) }}</td>
                <td class="td">
                    @if(!empty($payment->remarks))
                    {{ $payment->remarks }}
                    @else
                    <span>No Remarks Found</span>
                    @endif
                </td>
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

    <!-- Modal -->
    @foreach($paymentRequestDetails as $payment)
    <div class="modal fade" id="desc{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="desc" aria-hidden="true">
        <div class="modal-dialog">
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
    <div class="modal fade" id="reject{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="reject" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.rejected.status', $payment->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reject">Rejected Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to reject this payment request?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Rejected</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <!-- Modal -->
    @foreach($paymentRequestDetails as $payment)
    <div class="modal fade" id="approve{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="approve" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.approved.status', $payment->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approve">Approved Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to approve this payment request?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Approved</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <!-- Modal -->
    @foreach($paymentRequestDetails as $payment)
    <div class="modal fade" id="remark{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="remark" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.add.remarks', $payment->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="remark">Add Remarks</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea name="remarks" class="form-control" id="remarks" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</body>

</html>