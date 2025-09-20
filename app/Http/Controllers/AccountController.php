<?php

namespace App\Http\Controllers;

use App\Mail\AdminPaymentStatusMail;
use App\Mail\CommercialRequestApprovalStatusMail;
use App\Mail\CommercialRequestMail;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\CommercialRequest;
use App\Models\PaymentApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // Account Login View
    public function accountLoginView()
    {
        return view('account.account-login');
    }

    // Account Register View
    public function accountRegisterView()
    {
        return view('account.account-register');
    }

    // Account Register
    public function accountRegister(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:accounts,email',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'name.required'     => 'Name is required.',
                'email.required'    => 'Email is required.',
                'email.email'       => 'Please enter a valid email address.',
                'email.unique'      => 'This email is already registered.',
                'password.required' => 'Password is required.',
                'password.min'      => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Password confirmation does not match.',
            ]);

            // Create Account
            Account::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('account.login')
                ->with('success', 'Registration successful! Please log in.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'There were some errors with your registration.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Account Login
    public function accountLogin(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::guard('account')->attempt([
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ])) {
            $request->session()->regenerate();
            return redirect()->route('account.dashboard')
                ->with('success', 'Welcome Commercial Head!');
        }

        return back()->withErrors([
            'error' => 'Invalid email or password.',
        ])->withInput();
    }

    // Logout
    public function accountLogout(Request $request)
    {
        Auth::guard('account')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('account.login')
            ->with('success', 'You have been logged out.');
    }

    // Dashboard
    public function accountDashboardView(Request $request)
    {

        $query = PaymentApproval::with('user');


        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_code', 'like', "%{$search}%")
                    ->orWhere('remarks', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('payment_status', 'like', "%{$search}%")
                    ->orWhereJsonContains('request_for', $search)
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('staff_code', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $paymentRequestDetails = $query->orderBy('id', 'desc')->paginate(8)->appends($request->all());


        return view('account.account-dashboard', compact('paymentRequestDetails'));
    }

    // Pending Requests
    public function accountPendingRequestsView(Request $request)
    {
        $query = PaymentApproval::with('user')
            ->where('status', 'approved')
            ->where('payment_status', 'Pending');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_code', 'like', "%{$search}%")
                    ->orWhere('remarks', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('site_name', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('payment_status', 'like', "%{$search}%")
                    ->orWhereJsonContains('request_for', $search)
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('staff_code', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $paymentRequestDetails = $query->orderBy('id', 'desc')->paginate(8)->appends($request->all());
        return view('account.account-pending-requests', compact('paymentRequestDetails'));
    }

    // Payment Status Change
    public function paymentStatus($id)
    {
        $payment = PaymentApproval::findOrFail($id);

        $payment->update([
            'payment_status' => 'Done',
        ]);

        Mail::to('ranihati.construction@gmail.com')
            ->cc([
                'karmakarnetai866@gmail.com',
                'sayek@rconpl.in',
                'azaharuddin@rconpl.in',
                'rakibul@rconpl.in',
                'rubina.yashmin@rconpl.in',
                'payel.pal@rconpl.in',
                'sandip.das@rconpl.in',
                'soumen.singharoy@rconpl.in',
                'arindam.rcpl05@gmail.com',
                'subratadey.rcpl@gmail.com',
            ])
            ->send(new AdminPaymentStatusMail($payment, 'Done'));

        return redirect()->back()->with('success', 'Payment status updated to Done successfully.');
    }


    // Approved Requests
    public function accountApprovedRequestsView(Request $request)
    {
        $query = PaymentApproval::with('user')
            ->where('status', 'approved')
            ->where('payment_status', 'Done');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_code', 'like', "%{$search}%")
                    ->orWhere('remarks', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('site_name', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('payment_status', 'like', "%{$search}%")
                    ->orWhereJsonContains('request_for', $search)
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('staff_code', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $paymentRequestDetails = $query->orderBy('id', 'desc')->paginate(8)->appends($request->all());
        return view('account.account-approved-requests', compact('paymentRequestDetails'));
    }

    // Rejected Requests
    public function accountRejectedRequestsView(Request $request)
    {

        $query = PaymentApproval::with('user')
            ->where('status', 'rejected')
            ->where('payment_status', 'Pending');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_code', 'like', "%{$search}%")
                    ->orWhere('remarks', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('site_name', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('payment_status', 'like', "%{$search}%")
                    ->orWhereJsonContains('request_for', $search)
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('staff_code', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $paymentRequestDetails = $query->orderBy('id', 'desc')->paginate(8)->appends($request->all());
        return view('account.account-rejected-requests', compact('paymentRequestDetails'));
    }

    // All Requests
    public function accountAllRequestsView(Request $request)
    {
        $query = PaymentApproval::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_code', 'like', "%{$search}%")
                    ->orWhere('remarks', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('site_name', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('payment_status', 'like', "%{$search}%")
                    ->orWhereJsonContains('request_for', $search)
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('staff_code', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $paymentRequestDetails = $query->orderBy('id', 'desc')->paginate(8)->appends($request->all());
        return view('account.account-all-requests', compact('paymentRequestDetails'));
    }

    // PDF View
    public function acoountPdfView($id)
    {
        $payment = PaymentApproval::findOrFail($id);
        return view('pdf.admin-payment', compact('payment'));
    }

    // Profile
    public function accountProfileView()
    {
        return view('account.account-profile');
    }

    public function accountUpdateProfile(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::guard('account')->user();

        // Update name if provided
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    // My Request View
    public function accountMyRequestView(Request $request)
    {
        $query = CommercialRequest::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('approval_status', 'like', "%{$search}%")
                    ->orWhere('payment_status', 'like', "%{$search}%")
                    ->orWhere('payment_type', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('amount_in_words', 'like', "%{$search}%")
                    ->orWhere('remarks', 'like', "%{$search}%")
                    ->orWhere('reject_remarks', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $myRequests = $query->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->all());

        return view('account.account-my-request', compact('myRequests'));
    }


    public function accountMyRequestStore(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'date'            => 'required|date',
                'payment_type'    => 'required|string',
                'amount'          => 'required|numeric',
                'amount_in_words' => 'required|string',
                'remarks'         => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Validation failed. Please check the inputs.');
            }

            // Create CommercialRequest
            $commercialRequest = CommercialRequest::create([
                'date'            => $request->date,
                'approval_status' => 'pending',
                'payment_status'  => 'pending',
                'payment_type'    => $request->payment_type,
                'amount'          => $request->amount,
                'amount_in_words' => $request->amount_in_words,
                'remarks'         => $request->remarks,
            ]);

            // Send Mail with data
            Mail::to('arif424@gmail.com')
                ->cc([
                    'karmakarnetai866@gmail.com',
                    'sayek@rconpl.in',
                ])
                ->send(new CommercialRequestMail($commercialRequest));

            return redirect()->back()->with('success', 'Request submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function accountMyRequestPaymentStatusUpdate($id)
    {
        $payment = CommercialRequest::findOrFail($id);

        $payment->update([
            'payment_status' => 'done',
        ]);

        return redirect()->back()->with('success', 'Payment status updated to Done successfully.');
    }

    public function accountMyRequestUpdate(Request $request, $id)
    {
        $request->validate([
            'date'            => 'date',
            'payment_type'    => 'string',
            'amount'          => 'numeric',
            'amount_in_words' => 'string',
            'remarks'         => 'nullable|string',
        ]);

        $payment = CommercialRequest::findOrFail($id);

        $payment->update([
            'date'            => $request->date,
            'payment_type'    => $request->payment_type,
            'amount'          => $request->amount,
            'amount_in_words' => $request->amount_in_words,
            'remarks'         => $request->remarks,
        ]);

        return redirect()->back()->with('success', 'Request updated successfully!');
    }

    public function accountMyRequestDelete($id)
    {
        CommercialRequest::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Request deleted successfully!');
    }

    public function showMyRequestPdf($id)
    {
        $payment = CommercialRequest::findOrFail($id);
        return view('account.account-my-request-pdf-view', compact('payment'));
    }
}
