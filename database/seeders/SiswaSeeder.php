<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{

    public function run(): void
    {
         $siswa = Siswa::insert([
            [
                'nama' => 'ABU BAKAR TSABIT GHUFRON',
                'nis' => '20388',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '085839328609',
                'email' => 'makinamikayumi@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'MUTIARA SEKAR KINASIH',
                'nis' => '20431',
                'gender' => 'P',
                'alamat' => 'Bantul',
                'kontak' => '085198553807',
                'email' => 'mtiaraskinasih@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'ADE ZAIDAN ALTHAF',
                'nis' => '20390',
                'gender' => 'L',
                'alamat' => 'GUnungkidul',
                'kontak' => '087786760589',
                'email' => 'adezaidan24@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'ANGELINA THITHIS SEKAR LANGIT',
                'nis' => '20396',
                'gender' => 'P',
                'alamat' => 'Kulonprogo',
                'kontak' => '081272353535',
                'email' => 'arrowofdarkness2@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'MARCELLINUS CHRISTO PRADIPTA',
                'nis' => '20422',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '089688361696',
                'email' => 'marchllinuschristo11@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'NAUFELIRNA SUBKHI RAMADHANI',
                'nis' => '20454',
                'gender' => 'P',
                'alamat' => 'Klaten',
                'kontak' => '089671421234',
                'email' => 'adzanaufel705@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'ROSYIDAH MUTHMAINNAH',
                'nis' => '20448',
                'gender' => 'P',
                'alamat' => 'Sleman',
                'kontak' => '087883538770',
                'email' => 'rosyi.html@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'GABRIEL POSSENTI GENTA BAHANA NAGARI',
                'nis' => '20410',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '089634085990',
                'email' => 'gentapossenti@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'NAFISYA RHEA PRAYASTI',
                'nis' => '20410',
                'gender' => 'P',
                'alamat' => 'Bantul',
                'kontak' => '08816752848',
                'email' => 'nafisyarhea29@gmail.com',
                'status_lapor_pkl'=> false,
            ],
            [
                'nama' => 'FARCHA AMALIA NUGRAHAINI',
                'nis' => '20408',
                'gender' => 'P',
                'alamat' => 'Sleman',
                'kontak' => '0895380761274',
                'email' => 'farchaamalia@gmail.com',
                'status_lapor_pkl'=> false,
            ],
        ]);
    }
}
