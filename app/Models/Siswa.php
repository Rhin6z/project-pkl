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

    // Relasi dengan PKL
    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }

    // Accessor untuk mendapatkan gender yang sudah diformat menggunakan MySQL function
    public function getGenderTextAttribute()
    {
        return DB::selectOne("SELECT getGenderCode(?) as gender_text", [$this->gender])->gender_text;
    }

    // Scope untuk filter berdasarkan status PKL
    public function scopeWithPklStatus($query, $status = null)
    {
        if ($status !== null) {
            return $query->where('status_lapor_pkl', $status);
        }
        return $query;
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nis', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
    }

    // Method untuk mendapatkan statistik gender menggunakan MySQL function
    public static function getGenderStats()
    {
        return DB::select("
            SELECT
                gender,
                getGenderCode(gender) as gender_text,
                COUNT(*) as total
            FROM siswas
            GROUP BY gender
        ");
    }
}
