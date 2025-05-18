<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\Pkl;

class Dashboard extends Component
{
    public $totalSiswa, $totalGuru, $totalIndustri, $totalLaporan, $persenLaporanDisetujui;

    public function mount()
    {
        $this->totalSiswa = Siswa::count();
        $this->totalGuru = Guru::count();
        $this->totalIndustri = Industri::count();
        $this->totalLaporan = Pkl::count(); // ini masih oke buat total laporan (kalau relevan)

        $disetujui = Siswa::where('status_lapor_pkl', '1')->count();
        $this->persenLaporanDisetujui = $this->totalSiswa > 0
            ? round(($disetujui / $this->totalSiswa) * 100, 2)
            : 0;
    }

    public function render()
    {
        return view('livewire.front.dashboard.index');
    }
}

