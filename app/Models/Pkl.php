<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pkl extends Model
{
    protected $fillable = ['guru_id','siswa_id','industri_id','mulai','selesai'];

    public function guru() {
        return $this->belongsTo(Guru::class);
    }

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function industri() {
        return $this->belongsTo(Industri::class);
    }
}