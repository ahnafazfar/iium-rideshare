<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'matric_no' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'matric_card' => ['required', 'image', 'max:2048'],

            // At least one is required
            'whatsapp' => ['nullable', 'required_without:telegram', 'string', 'max:20'],
            'telegram' => ['nullable', 'required_without:whatsapp', 'string', 'max:50'],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $path = $request->file('matric_card')->store('matric_cards', 'public');

        // Clean inputs before saving (optional but good practice)
        $whatsapp = $request->whatsapp ? preg_replace('/[^0-9]/', '', $request->whatsapp) : null;
        $telegram = $request->telegram ? ltrim($request->telegram, '@') : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'matric_no' => $request->matric_no,
            'whatsapp' => $whatsapp,
            'telegram' => $telegram,
            'matric_card_path' => $path,
            'password' => Hash::make($request->password),
            'role' => 'passenger',
            'verified' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
