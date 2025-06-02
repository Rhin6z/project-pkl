<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'industri_id',
        'guru_id',
        'mulai',
        'selesai'
    ];

    protected $casts = [
        'mulai' => 'date',
        'selesai' => 'date',
    ];

    // Relationships
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Essential methods only
    public function scopeSearch($query, $search)
    {
        return $query->whereHas('siswa', fn($q) => $q->where('nama', 'like', "%{$search}%"))
                    ->orWhereHas('industri', fn($q) => $q->where('nama', 'like', "%{$search}%"))
                    ->orWhereHas('guru', fn($q) => $q->where('nama', 'like', "%{$search}%"));
    }
}
