<?php

namespace Database\Seeders;

use App\Models\Industri;
use Illuminate\Database\Seeder;

class IndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Industri::insert([
            // Data awal
            [
                'nama' => 'PT Aksa Digital Group',
                'bidang_usaha' => 'IT Service and IT Consulting (Information Technology Company)',
                'alamat' => 'Jl. Wongso Permono No.26, Klidon, Sukoharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',
                'kontak' => '08982909000',
                'email' => 'aksa@gmail.com',
                'website' => 'https://aksa.id/',
            ],
            [
                'nama' => 'PT. Gamatechno Indonesia',
                'bidang_usaha' => 'Penyedia layanan, solusi, dan produk inovasi teknologi informasi serta holding company yang melahirkan startup di bidang teknologi informasi.',
                'alamat' => 'Jl. Purwomartani, Karangmojo, Purwomartani, Kec. Kalasan, Kabupaten Sleman, Daerah Istimewa Yogyakarta',
                'kontak' => '0274-5044044',
                'email' => 'info@gamatechno.com',
                'website' => 'https://www.gamatechno.com/',
            ],
            [
                'nama' => 'CV. Karya Hidup Sentosa',
                'bidang_usaha' => 'Alat pertanian',
                'alamat' => 'Jl. Magelang KM.8,8, Jongke Tengah, Sendangadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55285',
                'kontak' => '0274-512095',
                'email' => 'quick@gmail.com',
                'website' => 'https://www.quick.co.id/',
            ],

            [
                'nama' => 'PT. Gagas Anagata Nusantara',
                'bidang_usaha' => 'Manufaktur / Permesinan / Otomatisasi',
                'alamat' => 'Jalan Dworowati No.11 Nglarang, Malangrejo, Wedomartani, Ngemplak, Sleman, DIY',
                'kontak' => '0274-963966',
                'email' => 'info@ichibot.id',
                'website' => 'https://ichibot.id',
            ],
            [
                'nama' => 'PT. Pura Barutama Kudus (Pura Group)',
                'bidang_usaha' => 'Plastik / Karet / Kertas / Kimia',
                'alamat' => 'Jl. Kresna, Jatimulyo, Jati Wetan, Kec. Jati, Kab. Kudus, Jawa Tengah 59346',
                'kontak' => '+62 291 444361',
                'email' => 'info@puragroup.com',
                'website' => 'https://www.puragroup.com/id/kemasan-cetak-offset/',
            ],
            [
                'nama' => 'PT. Saraswanti Indo Genetech',
                'bidang_usaha' => 'Pengolahan Limbah / Manajemen Lingkungan',
                'alamat' => 'Jl. Rasamala, Ring Road Taman Yasmin No.20, Curugmekar, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16113',
                'kontak' => '+62 251 7532 348',
                'email' => 'info@siglaboratory.com',
                'website' => 'https://siglaboratory.com/id/',
            ],
            [
                'nama' => 'PT. Kencana Gemilang (Miyako)',
                'bidang_usaha' => 'Peralatan Elektronik',
                'alamat' => 'Jl. Raya Serang KM. RW.8, Talaga, Kec. Cikupa, Kab. Tangerang, Banten 15710',
                'kontak' => '(021) 5960204',
                'email' => 'info@miyako.co.id',
                'website' => 'https://miyako.co.id',
            ],
            [
                'nama' => 'PT. Solunova Alami Indonesia',
                'bidang_usaha' => 'Plastik / Karet / Kertas / Kimia',
                'alamat' => 'KIK, Jl. Indraprasta No.9, Tambak, Wonorejo, Kec. Kaliwungu, Kab. Kendal, Jawa Tengah 51372',
                'kontak' => '+6224 3000 9999',
                'email' => 'info@solunova.co.id',
                'website' => 'https://www.solunova.co.id/',
            ],
            [
                'nama' => 'Taruna Motor - General Repair dan Body Repair',
                'bidang_usaha' => 'Kendaraan Bermotor / Ban / Otomotif',
                'alamat' => 'Jl. Gito Gati, Banaran, Tridadi, Sleman',
                'kontak' => '0813-2904-1228',
                'email' => 'info@tm_tarunamotor.id',
                'website' => 'https://tm_tarunamotor.id',
            ],
        ]);
    }
}
