<?php

namespace App\Livewire\Front\Dashboard;

use Livewire\Component;
use App\Models\Pkl;
use Illuminate\Support\Facades\Auth;

class SiswaIndex extends Component
{
    public $greeting;
    public $currentTime;

    public function mount()
    {
        $hour = now()->format('H');

        if ($hour < 12) {
            $this->greeting = 'Selamat Pagi';
        } elseif ($hour < 17) {
            $this->greeting = 'Selamat Siang';
        } else {
            $this->greeting = 'Selamat Malam';
        }

        $this->currentTime = now()->format('l, F j, Y');
    }

    public function render()
    {
        $user = Auth::user();
        $siswa = $user->siswa; // Asumsi relasi user->siswa sudah ada

        // Stats khusus untuk siswa
        $stats = [
            'total_pkl' => $siswa ? Pkl::where('siswa_id', $siswa->id)->count() : 0,
            'pkl_aktif' => $siswa ? Pkl::where('siswa_id', $siswa->id)
                                      ->whereDate('mulai', '<=', now())
                                      ->whereDate('selesai', '>=', now())
                                      ->count() : 0,
            'pkl_selesai' => $siswa ? Pkl::where('siswa_id', $siswa->id)
                                        ->whereDate('selesai', '<', now())
                                        ->count() : 0,
            'pkl_akan_datang' => $siswa ? Pkl::where('siswa_id', $siswa->id)
                                            ->whereDate('mulai', '>', now())
                                            ->count() : 0,
        ];

        // PKL history untuk siswa
        $my_pkls = $siswa ? Pkl::with(['guru', 'industri'])
                              ->where('siswa_id', $siswa->id)
                              ->latest()
                              ->take(5)
                              ->get() : collect();

        // Current active PKL
        $current_pkl = $siswa ? Pkl::with(['guru', 'industri'])
                                  ->where('siswa_id', $siswa->id)
                                  ->whereDate('mulai', '<=', now())
                                  ->whereDate('selesai', '>=', now())
                                  ->first() : null;

        return view('livewire.front.dashboard.siswa-index', compact('stats', 'my_pkls', 'current_pkl'));
    }
}
