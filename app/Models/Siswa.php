<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'gender',
        'alamat',
        'kontak',
        'email',
        'status_lapor_pkl'
    ];

    protected $casts = [
        'status_lapor_pkl' => 'boolean',
    ];

    public function pkls()
    {
        return $this->hasMany(Pkl::class, 'siswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

}
