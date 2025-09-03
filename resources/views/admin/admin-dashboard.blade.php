<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js">
    </script>
    <!-- icon -->
    <link rel="icon" href="{{ asset('./img/rupee.png') }}" />
    <title>Admin Dashboard</title>

    <style>
        .custom-success-popup,
        .custom-error-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            z-index: 9999;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeInOut 4s ease-in-out forwards;
        }

        .custom-success-popup {
            background-color: #4CAF50;
        }

        .custom-error-popup {
            background-color: #f44336;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            10% {
                opacity: 1;
                transform: translateY(0);
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body style="margin: 50px; background-color: #f8f9fa;">
    <div class="d-flex justify-content-between align-items-center mb-3 gap-4">
        <h2 class="mb-3 w-100">All Payments Requests</h2>

        <form action="{{ route('admin.dashboard') }}" method="GET" class="w-100 d-flex gap-2 mb-3">
            <input
                type="text"
                class="form-control border border-primary"
                name="search"
                placeholder="Search the payment request"
                value="{{ request('search') }}">
            <input
                type="date"
                class="form-control border border-primary"
                name="date"
                value="{{ request('date') }}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Reset</a>
        </form>



        <div class="w-100 d-flex align-items-center justify-content-end">
            <a class="btn btn-primary" href="{{ route('export.payment.requests') }}"
                style="font-size: 20px;">
                Export
            </a>

            &nbsp;
            &nbsp;
            &nbsp;

            <a class="btn btn-secondary" href="{{ route('admin.logout') }}"
                style="font-size: 20px;">
                Logout
            </a>
        </div>

    </div>
    <table class="table table-hover table-responsive table-bordered" style="border: 1px solid #000;">
        <thead>
            <tr>
                <th class="th">SL.</th>
                <th class="th">PDF</th>
                <th class="th">MD's Action</th>
                <th class="th">Approval Status</th>
                <th class="th">Payment Status</th>
                <th class="th">Date</th>
                <th class="th">Site Name</th>
                <th class="th">Request For</th>
                <th class="th">Item Description</th>
                <th class="th">Amount</th>
                <th class="th">Remarks</th>
                <th class="th">Vendor Details</th>
                <th class="th">Staff Details</th>
                <th class="th">Account's Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paymentRequestDetails as $payment)
            <tr>
                <td class="td">{{ $loop->iteration }}</td>
                <td class="td">
                    <a href="{{ route('admin.payment.pdf.view', $payment->id) }}" class="btn btn-primary">PDF</a>
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
                <td class="td">
                    @if($payment->payment_status == 'Pending')
                    <span class="badge rounded-border bg-warning text-dark p-3">Pending</span>
                    @elseif($payment->payment_status == 'Done')
                    <span class="badge rounded-border bg-success p-3">Done</span>
                    @endif
                </td>
                <td class="td"><strong>{{ $payment->date?->format('d M Y') }}</strong></td>
                <td class="td"><strong>{{ $payment->site_name}}</strong></td>
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

                <td class="td" style="white-space: normal; word-wrap: break-word; max-width: 200px;">
                    <small>{{ $payment->item_description }}</small>
                </td>


                <td class="td"><strong>₹ {{ number_format($payment->amount, 2) }}</strong></td>
                <td class="td">
                    @if(!empty($payment->remarks))
                    <strong>{{ $payment->remarks }}</strong>
                    @else
                    <span>No Remarks Found</span>
                    @endif
                </td>
                <td class="td">
                    <p class="m-0">Vendor: <strong>{{ $payment->vendor_name }}</strong></p>
                    <p class="m-0">Code: <strong>{{ $payment->vendor_code }}</strong></p>
                </td>

                <td class="td">
                    <p class="m-0">{{ $payment->user->name }}</p>
                    <p class="m-0">Code: {{ $payment->user->staff_code }}</p>
                    <p class="m-0">{{ $payment->user->email }}</p>
                    <p class="m-0">{{ $payment->user->mobile }}</p>
                </td>

                <td class="td">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#account{{ $payment->id }}" data-bs-backdrop="static">
                        Change Status
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="14" class="text-center">No record found</td>
            </tr>
            @endforelse
        </tbody>

    </table>


    @if ($paymentRequestDetails->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-4 align-items-center">

            <!-- {{-- Prev Button --}} -->
            <li class="page-item {{ $paymentRequestDetails->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link btn btn-primary"
                    href="{{ $paymentRequestDetails->previousPageUrl() }}">Prev</a>
            </li>
            &nbsp;
            <!-- {{-- Page Input + Total --}} -->
            <li class="page-item d-flex align-items-center" style="margin: 0 2px;">
                <form action="" method="GET" class="d-flex align-items-center" style="margin:0; padding:0;">
                    <input type="number" name="page"
                        value="{{ $paymentRequestDetails->currentPage() }}"
                        min="1"
                        max="{{ $paymentRequestDetails->lastPage() }}"
                        class="form-control">
                    <input type="text"
                        value="/ {{ $paymentRequestDetails->lastPage() }}"
                        readonly
                        class="form-control">
                </form>
            </li>
            &nbsp;
            <!-- {{-- Next Button --}} -->
            <li class="page-item {{ !$paymentRequestDetails->hasMorePages() ? 'disabled' : '' }}" style="">
                <a class="page-link btn btn-primary"
                    href="{{ $paymentRequestDetails->nextPageUrl() }}">Next</a>
            </li>

        </ul>
    </nav>
    @endif

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


    <!-- Modal -->
    @foreach($paymentRequestDetails as $payment)
    <div class="modal fade" id="account{{ $payment->id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="account" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.payment.status', $payment->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approve">Change Payment's Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="form-check-label">Choose Status</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        <option value="" selected disabled>{{ $payment->payment_status }}</option>
                        @if ($payment->payment_status == 'Pending')
                        <option value="Done">Done</option>
                        @elseif ($payment->payment_status == 'Done')
                        <option value="Pending">Pending</option>
                        @endif
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach


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
</body>

</html>