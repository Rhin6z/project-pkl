<?php

namespace App\Livewire\Front\Siswa;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Industri;
use App\Models\Pkl;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $userMail;
    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->userMail = Auth::user()->email;
    }

    public function render()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'total_guru' => Guru::count(),
            'total_industri' => Industri::count(),
            'total_pkl_aktif' => Pkl::whereDate('mulai', '<=', now())
                                   ->whereDate('selesai', '>=', now())
                                   ->count(),
            'pkl_selesai' => Pkl::whereDate('selesai', '<', now())->count(),
            'pkl_akan_datang' => Pkl::whereDate('mulai', '>', now())->count(),
            'status_lapor_pkl' => Siswa::count() > 0 ? Siswa::where('status_lapor_pkl', true)->count() : 0,
        ];

        $recent_pkls = Pkl::with(['siswa', 'guru', 'industri'])
                          ->latest()
                          ->take(5)
                          ->get();

        return view('livewire.front.siswa.index', [
            'siswas' => Siswa::where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('nis', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->paginate(10),
            // 'siswa' => Siswa::where('email', '=', $this->userMail)->first(), //tidak digunakan karena untuk data seluruh siswa tidak bisa dilihat siswa lain
        ], compact('stats', 'recent_pkls'));
    }
}
