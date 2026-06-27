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
    
    public function create(): View
    {
        return view('auth.register');
    }

    public function createEmployee(): View
    {
        return view('auth.register-employee');
    }

    public function createManager(): View
    {
        return view('auth.register-manager');
    }

    /**
     * Handle the default registration request.
     *
     * @throws ValidationException
     */

    
    public function storeEmployee(Request $request): RedirectResponse
    {
        return $this->registerUser($request, 'employee');
    }

   
    public function storeManager(Request $request): RedirectResponse
    {
        return $this->registerUser($request, 'manager');
    }

    
    private function registerUser(Request $request, string $role): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}