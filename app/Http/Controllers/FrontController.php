<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function LoginView()
    {
        return view('home');
    }

    public function staffLogin(Request $request)
    {
        $request->validate([
            'staff_code' => 'required|string',
            'password'   => 'required|string|min:8',
        ]);

        $user = User::where('staff_code', $request->staff_code)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // create session manually
            $request->session()->put('staff_id', $user->id);
            $request->session()->put('staff_name', $user->name);
            $request->session()->put('staff_code', $user->staff_code);

            return redirect()->route('stuff.stuff-payment-form')
                ->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'staff_code' => 'Invalid Staff Code or Password.',
        ])->withInput();
    }

    public function signupView()
    {
        return view('stuff-register');
    }

    public function staffRegister(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'staff_code' => 'required|string|max:255|unique:users',
            'mobile'     => 'required|string|max:15|unique:users',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'staff_code' => $request->staff_code,
            'mobile'     => $request->mobile,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('home')->with('success', 'Registration successful! Please log in.');
    }


    public function forgetPasswordView()
    {
        return view('stuff-forget-password');
    }

    public function stuffPaymentFormView()
    {

        return view('stuff-payment-form');
    }

    public function stuffProfileView()
    {

        return view('stuff-profile');
    }
}
