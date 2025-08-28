<?php

namespace App\Http\Controllers;

use App\Exports\PaymentRequestExport;
use App\Models\Admin;
use App\Models\PaymentApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminLoginView()
    {
        return view('admin.admin-login');
    }

    public function adminRegisterView()
    {
        return view('admin.admin-register');
    }

    // Admin Register
    public function adminRegister(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:admins,email',
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

            // Create admin
            Admin::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('admin.login')
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

    // Admin Login
    public function adminLogin(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::guard('admin')->attempt([
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome Admin!');
        }

        return back()->withErrors([
            'error' => 'Invalid email or password.',
        ])->withInput();
    }

    // Logout
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out.');
    }

    // Payment PDF
    public function paymentPdfDownload($id)
    {
        $payment = PaymentApproval::findOrFail($id);

        // If you need to process the request_for data in the controller instead of the view:
        $selectedOptions = [];
        if (!empty($payment->request_for)) {
            if (is_string($payment->request_for)) {
                $decoded = json_decode($payment->request_for, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $selectedOptions = $decoded;
                } else {
                    // Extract options from text
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

        $pdf = Pdf::loadView('pdf.payment', compact('payment', 'selectedOptions'));
        return $pdf->download('payment-approval-' . $id . '.pdf');
    }


    public function adminDashboardView()
    {

        $paymentRequestDetails = PaymentApproval::orderBy('id', 'desc')->paginate(5);

        return view('admin.admin-dashboard', compact('paymentRequestDetails'));
    }

    public function exportInExcel()
    {
        return Excel::download(new PaymentRequestExport, 'payment_requests.xlsx');
    }
}
