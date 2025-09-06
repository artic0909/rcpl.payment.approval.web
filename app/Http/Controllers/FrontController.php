<?php

namespace App\Http\Controllers;

use App\Models\PaymentApproval;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{

    public function logoutStaff(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout successful');
    }


    public function LoginView()
    {
        return view('home');
    }

    public function staffLogin(Request $request)
    {
        // Simple validation
        $validated = $request->validate([
            'staff_code' => 'required|string|max:50',
            'password'   => 'required|string|min:8',
        ]);

        // Attempt login
        if (Auth::guard('staff')->attempt($validated)) {
            $request->session()->regenerate();
            return redirect()
                ->route('staff.staff-payment-form')
                ->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'error' => 'Invalid staff code or password.',
        ])->withInput();
    }



    public function signupView()
    {
        return view('staff-register');
    }

    public function staffRegister(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'       => 'required|string|max:255',
                'email'      => 'required|string|email|max:255|unique:users,email',
                'staff_code' => 'required|string|max:50|unique:users,staff_code',
                'mobile'     => 'required|string|max:15|unique:users,mobile',
                'password'   => 'required|string|min:8|confirmed',
            ], [
                // Custom messages
                'name.required'       => 'Name is required.',
                'email.required'      => 'Email is required.',
                'email.email'         => 'Please enter a valid email address.',
                'email.unique'        => 'This email is already registered.',
                'staff_code.required' => 'Staff code is required.',
                'staff_code.unique'   => 'This staff code is already taken.',
                'mobile.required'     => 'Mobile number is required.',
                'mobile.unique'       => 'This mobile number is already registered.',
                'password.required'   => 'Password is required.',
                'password.min'        => 'Password must be at least 8 characters.',
                'password.confirmed'  => 'Password confirmation does not match.',
            ]);

            // Create staff user
            User::create([
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'staff_code' => $validated['staff_code'],
                'mobile'     => $validated['mobile'],
                'password'   => Hash::make($validated['password']),
            ]);

            return redirect()->route('home')->with('success', 'Registration successful! Please log in.');
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

    public function forgetPasswordView()
    {
        return view('staff-forget-password');
    }

    public function staffForgetPassword() {}

    public function staffPaymentFormView()
    {

        $user = Auth::guard('staff')->user();

        $vendors = Vendor::all();

        return view('staff-payment-form', compact('user', 'vendors'));
    }

    public function staffPaymentForm(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'request_for' => 'required|array',
            'vendor_name' => 'required|string|max:255',
            'vendor_code' => 'nullable|string|max:100',
            'site_name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'amount_in_words' => 'required|string|max:500',
            'item_description' => 'nullable|string',
            'party_account_number' => 'required|string|max:50',
            'party_ifsc_code' => 'required|string|max:20',
            'party_bank_name' => 'required|string|max:255',
            'party_bank_branch_name' => 'nullable|string|max:255',
        ]);

        PaymentApproval::create([
            'user_id' => $validated['user_id'],
            'date' => $validated['date'],
            'request_for' => $validated['request_for'], // store as JSON
            'vendor_name' => $validated['vendor_name'],
            'vendor_code' => $validated['vendor_code'] ?? null,
            'site_name' => $validated['site_name'] ?? null,
            'amount' => $validated['amount'],
            'amount_in_words' => $validated['amount_in_words'],
            'item_description' => $validated['item_description'] ?? null,
            'party_account_number' => $validated['party_account_number'],
            'party_ifsc_code' => $validated['party_ifsc_code'],
            'party_bank_name' => $validated['party_bank_name'],
            'party_bank_branch_name' => $validated['party_bank_branch_name'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Payment approval form submitted successfully!');
    }

    // Show edit form
    public function staffPaymentFormEdit($id)
    {
        $user = Auth::guard('staff')->user();
        $payment = PaymentApproval::with('user')->findOrFail($id);
        $vendors = Vendor::all();
        return view('staff-edit-payment-form', compact('payment', 'user', 'vendors'));
    }

    // Update payment
    public function staffPaymentFormUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'request_for' => 'required|array',
            'vendor_name' => 'required|string|max:255',
            'vendor_code' => 'nullable|string|max:100',
            'site_name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'amount_in_words' => 'required|string|max:500',
            'item_description' => 'nullable|string',
            'party_account_number' => 'required|string|max:50',
            'party_ifsc_code' => 'required|string|max:20',
            'party_bank_name' => 'required|string|max:255',
            'party_bank_branch_name' => 'nullable|string|max:255',
        ]);

        $payment = PaymentApproval::findOrFail($id);

        $payment->update([
            'user_id' => $validated['user_id'],
            'date' => $validated['date'],
            'request_for' => $validated['request_for'],
            'vendor_name' => $validated['vendor_name'],
            'vendor_code' => $validated['vendor_code'] ?? null,
            'site_name' => $validated['site_name'] ?? null,
            'amount' => $validated['amount'],
            'amount_in_words' => $validated['amount_in_words'],
            'item_description' => $validated['item_description'] ?? null,
            'party_account_number' => $validated['party_account_number'],
            'party_ifsc_code' => $validated['party_ifsc_code'],
            'party_bank_name' => $validated['party_bank_name'],
            'party_bank_branch_name' => $validated['party_bank_branch_name'] ?? null,
        ]);

        return redirect()->route('staff.staff-profile')->with('success', 'Payment updated successfully!');
    }

    // Delete payment
    public function staffPaymentFormDelete($id)
    {
        $payment = PaymentApproval::findOrFail($id);
        $payment->delete();

        return redirect()->route('staff.staff-profile')->with('success', 'Payment deleted successfully!');
    }



    public function staffProfileView()
    {
        $user = Auth::guard('staff')->user();

        $paymentRequestDetails = PaymentApproval::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('staff-profile', compact('user', 'paymentRequestDetails'));
    }


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
                        'Plant Machinery Rent',
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

    public function profileUpdate(Request $request)
    {
        $user = Auth::guard('staff')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15|unique:users,mobile,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Only update allowed fields
        $updateData = [
            'name'   => $validated['name'],
            'mobile' => $validated['mobile'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = bcrypt($validated['password']);
        }

        $user->update($updateData);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function getVendorDetails($code)
    {
        $vendor = Vendor::where('vendor_code', $code)->first();

        if ($vendor) {
            return response()->json([
                'success' => true,
                'data' => $vendor
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Vendor not found'], 404);
    }
}
