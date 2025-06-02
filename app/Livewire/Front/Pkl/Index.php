<?php

namespace App\Livewire\Front\Pkl;

use App\Models\Pkl;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Industri;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $confirmingDeletion = false;
    public $deletingPklId = null;

    // Form fields
    public $siswaId, $industriId, $guruId, $mulai, $selesai;

    protected $rules = [
        'siswaId' => 'required|exists:siswas,id',
        'industriId' => 'required|exists:industris,id',
        'guruId' => 'required|exists:gurus,id',
        'mulai' => 'required|date|after_or_equal:today',
        'selesai' => 'required|date|after:mulai',
    ];

    public function mount()
    {
        // Auto-set siswa ID jika user adalah siswa
        if (Auth::user()->hasRole('siswa')) {
            $siswa = Siswa::where('email', Auth::user()->email)->first();
            $this->siswaId = $siswa?->id;
        }
    }

    public function render()
    {
        $query = Pkl::with(['siswa', 'industri', 'guru'])->latest();

        if ($this->search) {
            $query->search($this->search);
        }

        $currentUser = Auth::user();
        $isStudent = $currentUser->hasRole('siswa');

        // Filter PKL berdasarkan role
        if ($isStudent) {
            $siswa = Siswa::where('email', $currentUser->email)->first();
            if ($siswa) {
                $query->where('siswa_id', $siswa->id);
            }
        }

        // Get siswa_login untuk keperluan form
        $siswa_login = null;
        if ($isStudent) {
            $siswa_login = Siswa::where('email', $currentUser->email)->first();
        }

        return view('livewire.front.pkl.index', [
            'pkls' => $query->paginate(10),
            'userMail' => $currentUser->email,
            'industris' => Industri::all(),
            'gurus' => Guru::all(),
            'siswas' => $isStudent ? collect() : Siswa::all(),
            'isStudent' => $isStudent,
            'siswa_login' => $siswa_login, // Add this variable
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    public function store()
    {
        $this->validate();

        // Validasi siswa sudah lapor
        $siswa = Siswa::find($this->siswaId);
        if ($siswa->status_lapor_pkl) {
            session()->flash('error', 'Siswa sudah melapor PKL.');
            return;
        }

        Pkl::create([
            'siswa_id' => $this->siswaId,
            'industri_id' => $this->industriId,
            'guru_id' => $this->guruId,
            'mulai' => $this->mulai,
            'selesai' => $this->selesai,
        ]);

        $this->resetForm();
        $this->isOpen = false;
        session()->flash('success', 'Data PKL berhasil disimpan!');
    }

    public function confirmDelete($id)
    {
        $this->deletingPklId = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        Pkl::find($this->deletingPklId)?->delete();

        $this->confirmingDeletion = false;
        $this->deletingPklId = null;
        session()->flash('success', 'Data PKL berhasil dihapus!');
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->deletingPklId = null;
    }

    private function resetForm()
    {
        $this->siswaId = Auth::user()->hasRole('siswa') ?
            Siswa::where('email', Auth::user()->email)->first()?->id : '';
        $this->industriId = '';
        $this->guruId = '';
        $this->mulai = '';
        $this->selesai = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
