<?php

namespace App\Http\Controllers;

use App\Exports\SiteCodeExport;
use App\Models\Creator;
use Illuminate\Http\Request;
use App\Models\PaymentApproval;
use App\Models\SiteCode;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
    public function creatorVendorCreateView(Request $request)
    {
        $sites = SiteCode::all();
        $search = $request->input('search');

        $vendors = Vendor::query()
            ->when($search, function ($query, $search) {
                $query->where('vendor_code', 'like', "%{$search}%")
                    ->orWhere('vendor_name', 'like', "%{$search}%")
                    ->orWhere('vendor_address', 'like', "%{$search}%")
                    ->orWhere('vendor_account_number', 'like', "%{$search}%")
                    ->orWhere('vendor_ifsc_code', 'like', "%{$search}%")
                    ->orWhere('vendor_bank_name', 'like', "%{$search}%")
                    ->orWhere('vendor_bank_branch_name', 'like', "%{$search}%")
                    ->orWhere('contact_person_name', 'like', "%{$search}%")
                    ->orWhere('contact_person_mobile', 'like', "%{$search}%")
                    ->orWhere('contact_person_email', 'like', "%{$search}%")
                    ->orWhere('related_product_service', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(8);

        // Keep search term in pagination links
        $vendors->appends(['search' => $search]);

        return view('creator.creator-vendors', compact('vendors', 'sites'));
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

    // Vendor Create
    public function creatorVendorStore(Request $request)
    {
        $validatedData = $request->validate([
            'state_code' => 'required|string',
            'vendor_name' => 'required|string|max:255',
            'vendor_code' => 'required|string|unique:vendors,vendor_code',
            'vendor_category' => 'required|array|min:1',
            'vendor_category.*' => 'string',
            'vendor_address' => 'nullable|string',
            'vendor_account_number' => 'nullable|string',
            'vendor_ifsc_code' => 'nullable|string',
            'vendor_bank_name' => 'nullable|string',
            'vendor_bank_branch_name' => 'nullable|string',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_mobile' => 'required|string|max:15',
            'contact_person_email' => 'nullable|email',
            'related_product_service' => 'nullable|string',
        ], [
            'vendor_code.unique' => 'This Vendor Code already exists. Please generate a new one.',
            'vendor_category.required' => 'Please select at least one category.',
        ]);

        try {
            $vendor = Vendor::create([
                'state_code' => $validatedData['state_code'],
                'vendor_name' => $validatedData['vendor_name'],
                'vendor_code' => $validatedData['vendor_code'],
                'vendor_category' => json_encode($validatedData['vendor_category']),
                'vendor_address' => $request->vendor_address,
                'vendor_account_number' => $request->vendor_account_number,
                'vendor_ifsc_code' => $request->vendor_ifsc_code,
                'vendor_bank_name' => $request->vendor_bank_name,
                'vendor_bank_branch_name' => $request->vendor_bank_branch_name,
                'contact_person_name' => $validatedData['contact_person_name'],
                'contact_person_mobile' => $validatedData['contact_person_mobile'],
                'contact_person_email' => $request->contact_person_email,
                'related_product_service' => $request->related_product_service,
            ]);

            return redirect()->back()->with('success', 'Vendor added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function creatorEditVendorView($id)
    {
        $sites = SiteCode::all();
        $vendor = Vendor::find($id);

        return view('creator.creator-vendor-edit', compact('vendor', 'sites'));
    }

    public function creatorUpdateVendor(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);


        $validated = $request->validate([
            'state_code' => 'required|string|max:10',
            'vendor_name' => 'required|string|max:255',
            'vendor_code' => 'required|string|max:50|unique:vendors,vendor_code,' . $vendor->id,
            'vendor_category' => 'required|array',
            'vendor_category.*' => 'string',
            'vendor_address' => 'nullable|string|max:255',
            'vendor_account_number' => 'nullable|string|max:50',
            'vendor_ifsc_code' => 'nullable|string|max:50',
            'vendor_bank_name' => 'nullable|string|max:100',
            'vendor_bank_branch_name' => 'nullable|string|max:100',
            'contact_person_name' => 'required|string|max:100',
            'contact_person_mobile' => 'required|string|max:20',
            'contact_person_email' => 'nullable|email|max:100',
            'related_product_service' => 'nullable|string|max:255',
        ]);

     
        $vendor->update([
            'state_code' => strtoupper($validated['state_code']),
            'vendor_name' => $validated['vendor_name'],
            'vendor_code' => strtoupper($validated['vendor_code']),
            'vendor_category' => json_encode($validated['vendor_category']),
            'vendor_address' => $validated['vendor_address'] ?? null,
            'vendor_account_number' => $validated['vendor_account_number'] ?? null,
            'vendor_ifsc_code' => strtoupper($validated['vendor_ifsc_code'] ?? ''),
            'vendor_bank_name' => $validated['vendor_bank_name'] ?? null,
            'vendor_bank_branch_name' => $validated['vendor_bank_branch_name'] ?? null,
            'contact_person_name' => $validated['contact_person_name'],
            'contact_person_mobile' => $validated['contact_person_mobile'],
            'contact_person_email' => $validated['contact_person_email'] ?? null,
            'related_product_service' => $validated['related_product_service'] ?? null,
        ]);

        return redirect()->route('creator.vendor-create.edit', $vendor->id)
            ->with('success', 'Vendor updated successfully!');
    }



    public function creatorDeleteVendor($id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return redirect()->back()->with('error', 'Vendor not found.');
        }

        try {
            $vendor->delete();
            return redirect()->back()->with('success', 'Vendor deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function creatorSiteCodeView(Request $request)
    {
        $sites = SiteCode::orderby('id', 'desc')->paginate(8);

        $search = $request->input('search');

        $sites = SiteCode::query()
            ->when($search, function ($query, $search) {
                $query->where('site_code', 'like', "%{$search}%")
                    ->orWhere('site_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(8);

        // Keep search term in pagination links
        $sites->appends(['search' => $search]);

        return view('creator.creator-site-code', compact('sites'));
    }

    public function creatorSiteCode(Request $request)
    {
        $validatedData = $request->validate([
            'site_code' => 'required|string|unique:site_codes,site_code',
            'site_name' => 'required|string',
            'location' => 'nullable|string',
        ], [
            'site_code.unique' => 'This Site Code already exists. Please generate a new one.',
        ]);

        try {
            $site = SiteCode::create([
                'site_code' => $validatedData['site_code'],
                'site_name' => $validatedData['site_name'],
                'location' => $validatedData['location'],
            ]);

            return redirect()->back()->with('success', 'Site code added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function creatorUpdateSiteCode(Request $request, $id)
    {
        $validatedData = $request->validate([
            'site_code' => 'required|string|unique:site_codes,site_code,' . $id,
            'site_name' => 'required|string',
            'location' => 'nullable|string',
        ]);

        try {
            $site = SiteCode::find($id);
            $site->site_code = $validatedData['site_code'];
            $site->site_name = $validatedData['site_name'];
            $site->location = $validatedData['location'];
            $site->save();

            return redirect()->back()->with('success', 'Site code updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function creatorDeleteSiteCode($id)
    {
        $site = SiteCode::find($id);

        if (!$site) {
            return redirect()->back()->with('error', 'Site code not found.');
        }

        try {
            $site->delete();
            return redirect()->back()->with('success', 'Site code deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function siteCodesExportAsExcel()
    {
        return Excel::download(new SiteCodeExport, 'site_codes.xlsx');
    }
}
