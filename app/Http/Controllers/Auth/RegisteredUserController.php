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
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): Response
    {

        $props['prop_referral_id'] = $request->query('u');
        return Inertia::render('Auth/NewRegister', $props);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $seeder = false): RedirectResponse
    {
        $request->validate([
            'user_name' => ['required', 'alpha_dash', 'max:60', 'unique:' . User::class],
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'phone' => 'required|numeric|min_digits:7|max_digits:15|unique:users,phone',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'sponsor_user_id' => !is_null(User::find($request->id)) ? $request->id : 10,
            'country_id' => 151,
            'remember_token' => Str::random(10),
        ]);

        $user_id = $user->id;

        $now = DB::raw('NOW()');
        $user->last_activity = $now;
        $user->save();

        if(!$seeder){
            event(new Registered($user));
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
