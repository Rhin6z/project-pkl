<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $fillable = ['nama','bidang_usaha','alamat','kontak','email','website'];

    public function pkls() {
        return $this->hasMany(Pkl::class);
    }
}