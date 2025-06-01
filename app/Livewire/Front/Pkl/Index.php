<?php

namespace App\Livewire\Front\Pkl;

use App\Models\Pkl;
use App\Models\Guru;
use App\Models\Siswa;
use Livewire\Component;
use App\Models\Industri;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $siswaId, $industriId, $guruId, $mulai, $selesai;
    public $isOpen = 0;

    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $statusFilter = '';
    public $userMail;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->userMail = Auth::user()->email;

        // Auto-set siswaId jika user adalah siswa
        if (Auth::user()->hasRole('siswa')) {
            $siswa_login = Siswa::where('email', $this->userMail)->first();
            if ($siswa_login) {
                $this->siswaId = $siswa_login->id;
            } else {
                session()->flash('error', 'Data siswa tidak ditemukan untuk email: ' . $this->userMail);
            }
        }
    }

    public function render()
    {
        $siswa_login = Siswa::where('email', $this->userMail)->first();

        // Build query untuk PKL
        $pklQuery = Pkl::with(['siswa', 'industri', 'guru'])->latest();

        // Apply search filter
        if ($this->search) {
            $pklQuery->search($this->search);
        }

        // Apply status filter
        if ($this->statusFilter) {
            switch ($this->statusFilter) {
                case 'aktif':
                    $pklQuery->aktif();
                    break;
                case 'selesai':
                    $pklQuery->selesai();
                    break;
                case 'akan_datang':
                    $pklQuery->akanDatang();
                    break;
            }
        }

        // Get statistics
        $stats = [
            'total_pkl' => Pkl::count(),
            'pkl_aktif' => Pkl::aktif()->count(),
            'pkl_selesai' => Pkl::selesai()->count(),
            'pkl_akan_datang' => Pkl::akanDatang()->count(),
            'total_siswa' => Siswa::count(),
            'siswa_sudah_lapor' => Siswa::where('status_lapor_pkl', true)->count(),
        ];

        $data = [
            'pkls' => $pklQuery->paginate(10),
            'siswa_login' => $siswa_login ?? new \stdClass(),
            'industris' => Industri::all(),
            'gurus' => Guru::all(),
            'stats' => $stats,
        ];

        // Jika role bukan siswa, tambahkan data semua siswa
        if (!Auth::user()->hasRole('siswa')) {
            $data['siswas'] = Siswa::all();

            if ($this->siswaId) {
                $data['siswa'] = Siswa::find($this->siswaId);
            } else {
                $data['siswa'] = null;
            }
        }

        return view('livewire.front.pkl.index', $data);
    }

    public function create()
    {
        $this->resetInputFields();

        // Auto-set siswaId jika user adalah siswa
        if (Auth::user()->hasRole('siswa')) {
            $siswa_login = Siswa::where('email', $this->userMail)->first();
            if ($siswa_login) {
                $this->siswaId = $siswa_login->id;
            } else {
                session()->flash('error', 'Data siswa tidak ditemukan. Hubungi administrator.');
                return;
            }
        }

        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        if (!Auth::user()->hasRole('siswa')) {
            $this->siswaId = '';
        }

        $this->industriId = '';
        $this->guruId = '';
        $this->mulai = '';
        $this->selesai = '';
    }

    public function store()
    {
        $this->validate([
            'siswaId' => 'required|exists:siswas,id',
            'industriId' => 'required|exists:industris,id',
            'guruId' => 'required|exists:gurus,id',
            'mulai' => 'required|date|after_or_equal:today',
            'selesai' => 'required|date|after:mulai',
        ], [
            'siswaId.required' => 'Pilih siswa terlebih dahulu.',
            'siswaId.exists' => 'Siswa yang dipilih tidak valid.',
            'industriId.required' => 'Pilih industri terlebih dahulu.',
            'industriId.exists' => 'Industri yang dipilih tidak valid.',
            'guruId.required' => 'Pilih guru pembimbing terlebih dahulu.',
            'guruId.exists' => 'Guru yang dipilih tidak valid.',
            'mulai.required' => 'Tanggal mulai harus diisi.',
            'mulai.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
            'selesai.required' => 'Tanggal selesai harus diisi.',
            'selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        // Validasi tambahan: siswa hanya bisa input data untuk dirinya sendiri
        if (Auth::user()->hasRole('siswa')) {
            $siswa_login = Siswa::where('email', $this->userMail)->first();
            if ($siswa_login && $this->siswaId != $siswa_login->id) {
                $this->closeModal();
                session()->flash('error', 'Anda hanya bisa melapor untuk diri sendiri.');
                return;
            }
        }

        DB::beginTransaction();

        try {
            $siswa = Siswa::find($this->siswaId);

            if (!$siswa) {
                DB::rollBack();
                $this->closeModal();
                session()->flash('error', 'Data siswa tidak ditemukan.');
                return;
            }

            if ($siswa->status_lapor_pkl) {
                DB::rollBack();
                $this->closeModal();
                session()->flash('error', 'Input data error: Siswa sudah melapor PKL.');
                return;
            }

            // Simpan data PKL (trigger database akan mengupdate status_lapor_pkl otomatis)
            Pkl::create([
                'siswa_id' => $this->siswaId,
                'industri_id' => $this->industriId,
                'guru_id' => $this->guruId,
                'mulai' => $this->mulai,
                'selesai' => $this->selesai,
            ]);

            DB::commit();

            $this->closeModal();
            $this->resetInputFields();

            session()->flash('success', 'Data PKL berhasil disimpan! Status siswa telah diperbarui otomatis.');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->closeModal();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Add these properties to your Index.php class
    public $confirmingDeletion = false;
    public $deletingPklId = null;

    // Add this method to your Index.php class
    public function confirmDelete($id)
    {
        // Validasi authorization untuk siswa
        if (Auth::user()->hasRole('siswa')) {
            $pkl = Pkl::find($id);
            $siswa_login = Siswa::where('email', $this->userMail)->first();

            if (!$pkl || $pkl->siswa_id != $siswa_login->id) {
                session()->flash('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
                return;
            }
        }

        $this->deletingPklId = $id;
        $this->confirmingDeletion = true;
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->deletingPklId = null;
    }

    // Update your existing delete method
    public function delete()
    {
        if (!$this->deletingPklId) {
            return;
        }

        DB::beginTransaction();

        try {
            $pkl = Pkl::find($this->deletingPklId);

            if (!$pkl) {
                DB::rollBack();
                session()->flash('error', 'Data PKL tidak ditemukan.');
                return;
            }

            // Hapus data PKL (trigger database akan mengupdate status_lapor_pkl otomatis)
            $pkl->delete();

            DB::commit();

            session()->flash('success', 'Data PKL berhasil dihapus! Status siswa telah diperbarui otomatis.');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        $this->confirmingDeletion = false;
        $this->deletingPklId = null;
    }
    public function setStatusFilter($status)
    {
        $this->statusFilter = $this->statusFilter === $status ? '' : $status;
    }
}
