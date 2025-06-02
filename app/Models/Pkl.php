<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    // Relasi dengan Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi dengan Industri
    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }

    // Relasi dengan Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Accessor untuk mendapatkan durasi PKL dalam hari
    public function getDurasiHariAttribute()
    {
        return Carbon::parse($this->mulai)->diffInDays(Carbon::parse($this->selesai));
    }

    // Accessor untuk status PKL (aktif, selesai, akan datang)
    public function getStatusAttribute()
    {
        $now = Carbon::now();
        $mulai = Carbon::parse($this->mulai);
        $selesai = Carbon::parse($this->selesai);

        if ($now->lt($mulai)) {
            return 'akan_datang';
        } elseif ($now->between($mulai, $selesai)) {
            return 'aktif';
        } else {
            return 'selesai';
        }
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'aktif':
                return ['class' => 'bg-green-100 text-green-800', 'text' => 'Aktif'];
            case 'selesai':
                return ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Selesai'];
            case 'akan_datang':
                return ['class' => 'bg-blue-100 text-blue-800', 'text' => 'Akan Datang'];
            default:
                return ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Tidak Diketahui'];
        }
    }

    // Scope untuk PKL aktif
    public function scopeAktif($query)
    {
        return $query->whereDate('mulai', '<=', now())
                    ->whereDate('selesai', '>=', now());
    }

    // Scope untuk PKL selesai
    public function scopeSelesai($query)
    {
        return $query->whereDate('selesai', '<', now());
    }

    // Scope untuk PKL akan datang
    public function scopeAkanDatang($query)
    {
        return $query->whereDate('mulai', '>', now());
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->whereHas('siswa', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('industri', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('guru', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    });
    }

    // Method untuk mendapatkan statistik PKL
    public static function getStatistics()
    {
        return [
            'total' => self::count(),
            'aktif' => self::aktif()->count(),
            'selesai' => self::selesai()->count(),
            'akan_datang' => self::akanDatang()->count(),
        ];
    }

    // Boot method untuk handling events (meskipun trigger sudah ada di database)
    protected static function booted()
    {
        // Backup logic jika trigger database tidak berfungsi
        static::created(function ($pkl) {
            // Trigger database akan handle ini, tapi sebagai backup:
            // $pkl->siswa->update(['status_lapor_pkl' => true]);
        });

        static::deleted(function ($pkl) {
            // Trigger database akan handle ini, tapi sebagai backup:
            // $pkl->siswa->update(['status_lapor_pkl' => false]);
        });
    }
}
