<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at', // Added this line
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Check if user's email is verified
     */
    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Get avatar URL
     */
    public function getAvatarUrlAttribute(): string
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    // Event listener untuk sinkronisasi email
    protected static function booted()
    {
        static::updated(function ($user) {
            // Cek apakah email yang diubah
            if ($user->isDirty('email')) {
                $oldEmail = $user->getOriginal('email');
                $newEmail = $user->email;

                // Update email di tabel guru
                \App\Models\Guru::where('email', $oldEmail)
                    ->update(['email' => $newEmail]);

                // Update email di tabel siswa
                \App\Models\Siswa::where('email', $oldEmail)
                    ->update(['email' => $newEmail]);
            }
        });
    }

    // Relasi ke Guru (opsional, jika diperlukan)
    public function guru()
    {
        return $this->hasOne(\App\Models\Guru::class, 'email', 'email');
    }

    // Relasi ke Siswa (opsional, jika diperlukan)
    public function siswa()
    {
        return $this->hasOne(\App\Models\Siswa::class, 'email', 'email');
    }
}
