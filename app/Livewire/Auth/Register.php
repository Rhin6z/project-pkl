<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:'.User::class,
                function ($attribute, $value, $fail) {
                    // Check if email exists in siswa or guru table
                    $siswa = Siswa::where('email', $value)->first();
                    $guru = Guru::where('email', $value)->first();

                    if (!$siswa && !$guru) {
                        $fail('Email tidak terdaftar sebagai siswa atau guru.');
                    }
                },
            ],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Create user
        $user = User::create($validated);

        // Check user type and assign appropriate role
        $siswa = Siswa::where('email', $validated['email'])->first();
        $guru = Guru::where('email', $validated['email'])->first();

        // if ($siswa) {
        //     // Assign 'siswa' role to the user
        //     $user->assignRole('siswa');

        //     // Optional: Link the user to the siswa record
        //     $siswa->update(['user_id' => $user->id]);
        // } elseif ($guru) {
        //     // Assign 'guru' role to the user
        //     $user->assignRole('guru');

        //     // Optional: Link the user to the guru record
        //     $guru->update(['user_id' => $user->id]);
        // }

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
