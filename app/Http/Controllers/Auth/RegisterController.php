<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('authentication-register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'terms' => ['required', 'accepted'],
        ], [
            'terms.required' => 'You must agree to the Terms and Conditions.',
            'terms.accepted' => 'You must agree to the Terms and Conditions.',
        ]);

        // Get the default customer role
        $customerRole = Role::where('name', 'customer')->first();
        
        if (!$customerRole) {
            // Create customer role if it doesn't exist
            $customerRole = Role::create([
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Regular customer role'
            ]);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $customerRole->id,
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard or home page
        return redirect()->route('home')->with('success', 'Registration successful! Welcome to our car dealership.');
    }
}
