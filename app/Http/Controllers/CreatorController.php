<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Models\PaymentApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreatorController extends Controller
{
    // Account Login View
    public function creatorLoginView()
    {
        return view('creator.creator-login');
    }

    // Account Register View
    public function creatorRegisterView()
    {
        return view('creator.creator-register');
    }

    // Account Register
    public function creatorRegister(Request $request)
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
            Creator::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('creator.login')
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
    public function creatorLogin(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::guard('creator')->attempt([
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ])) {
            $request->session()->regenerate();
            return redirect()->route('creator.dashboard')
                ->with('success', 'Welcome Commercial Head!');
        }

        return back()->withErrors([
            'error' => 'Invalid email or password.',
        ])->withInput();
    }

    // Logout
    public function creatorLogout(Request $request)
    {
        Auth::guard('creator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('creator.login')
            ->with('success', 'You have been logged out.');
    }

    // Dashboard
    public function creatorDashboardView(Request $request)
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


        return view('creator.creator-dashboard', compact('paymentRequestDetails'));
    }

    // Vendor Create View
    public function creatorVendorCreateView()
    {
        return view('creator.creator-vendors');
    }

    public function creatorProfileView()
    {
        return view('creator.creator-profile');
    }

    public function creatorUpdateProfile(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::guard('creator')->user();

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
}
