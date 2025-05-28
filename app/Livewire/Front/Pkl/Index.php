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
    public $isOpen = 0; // This is initialized to 0 (closed)

    use WithPagination;

    public $rowPerPage = 3;
    public $search;
    public $userMail;

    public function mount(){
        //membaca email user yang sedang login
        $this->userMail = Auth::user()->email;

        // Auto-set siswaId jika user adalah siswa
        if (Auth::user()->hasRole('siswa')) {
            $siswa_login = Siswa::where('email', '=', $this->userMail)->first();
            if ($siswa_login) {
                $this->siswaId = $siswa_login->id;
            } else {
                // Log atau handle case ketika siswa tidak ditemukan
                session()->flash('error', 'Data siswa tidak ditemukan untuk email: ' . $this->userMail);
            }
        }
    }

    public function render()
    {
        $siswa_login = Siswa::where('email', '=', $this->userMail)->first();

        // Prepare data berdasarkan role
        $data = [
            'pkls' => $this->search === NULL ?
                        Pkl::latest()->paginate($this->rowPerPage) :
                        Pkl::latest()->whereHas('siswa', function ($query) {
                                                $query->where('nama', 'like', '%' . $this->search . '%');
                                            })
                                    ->orWhereHAs('industri', function ($query) {
                                                $query->where('nama', 'like', '%' . $this->search . '%');
                                    })->paginate($this->rowPerPage),

            'siswa_login' => $siswa_login ?? new \stdClass(), // Fallback jika null
            'industris' => Industri::all(),
            'gurus' => Guru::all(),
        ];

        // Jika role bukan siswa, tambahkan data semua siswa
        if (!Auth::user()->hasRole('siswa')) {
            $data['siswas'] = Siswa::all();

            // Tambahkan siswa untuk ditampilkan di header jika sudah dipilih
            if ($this->siswaId) {
                $data['siswa'] = Siswa::find($this->siswaId);
            } else {
                $data['siswa'] = null;
            }
        }

        // Make sure your blade file is at resources/views/livewire/front/pkl/index.blade.php
        return view('livewire.front.pkl.index', $data);
    }

    public function create()
    {
        $this->resetInputFields();

        // Auto-set siswaId jika user adalah siswa
        if (Auth::user()->hasRole('siswa')) {
            $siswa_login = Siswa::where('email', '=', $this->userMail)->first();
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

    private function resetInputFields(){
        // Jangan reset siswaId jika user adalah siswa
        if (!Auth::user()->hasRole('siswa')) {
            $this->siswaId = '';
        }

        $this->industriId   = '';
        $this->guruId       = '';
        $this->mulai        = '';
        $this->selesai      = '';
    }

    public function store()
    {
        $this->validate([
                'siswaId'       => 'required',
                'industriId'    => 'required',
                'guruId'        => 'required',
                'mulai'         => 'required|date',
                'selesai'       => 'required|date|after:mulai',
            ]);

        // Validasi tambahan: siswa hanya bisa input data untuk dirinya sendiri
        if (Auth::user()->hasRole('siswa')) {
            $siswa_login = Siswa::where('email', '=', $this->userMail)->first();
            if ($siswa_login && $this->siswaId != $siswa_login->id) {
                $this->closeModal();
                return redirect()->route('pkl')->with('error', 'Anda hanya bisa melapor untuk diri sendiri.');
            }
        }

        DB::beginTransaction();

        try {
            $siswa = Siswa::find($this->siswaId);

            if (!$siswa) {
                DB::rollBack();
                $this->closeModal();
                return redirect()->route('pkl')->with('error', 'Data siswa tidak ditemukan.');
            }

            if ($siswa->status_lapor_pkl) {
                DB::rollBack();
                $this->closeModal();
                return redirect()->route('pkl')->with('error', 'Input data error: Siswa sudah melapor.');
            }

            // Simpan data PKL
            Pkl::create([
                'siswa_id'      => $this->siswaId,
                'industri_id'   => $this->industriId,
                'guru_id'       => $this->guruId,
                'mulai'         => $this->mulai,
                'selesai'       => $this->selesai,
            ]);

            // Update status_lapor siswa
            $siswa->update(['status_lapor_pkl' => 1]);

            DB::commit();

            $this->closeModal();
            $this->resetInputFields();

            return redirect()->route('pkl')->with('success', 'Data PKL berhasil disimpan dan status siswa diperbarui!');

        }
        catch (\Exception $e) {
            DB::rollBack();
            $this->closeModal();
            return redirect()->route('pkl')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleting($id)
    {
        // Cek apakah user memiliki permission untuk delete
        // Untuk role siswa, mungkin hanya bisa delete data mereka sendiri
        if (Auth::user()->hasRole('siswa')) {
            $pkl = Pkl::find($id);
            $siswa_login = Siswa::where('email', '=', $this->userMail)->first();

            if (!$pkl || $pkl->siswa_id != $siswa_login->id) {
                return redirect()->route('pkl')->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
            }
        }

        DB::beginTransaction();

        try {
            $pkl = Pkl::find($id);

            if (!$pkl) {
                DB::rollBack();
                return redirect()->route('pkl')->with('error', 'Data PKL tidak ditemukan.');
            }

            // Update status_lapor siswa kembali ke 0
            $siswa = Siswa::find($pkl->siswa_id);
            if ($siswa) {
                $siswa->update(['status_lapor_pkl' => 0]);
            }

            // Hapus data PKL
            $pkl->delete();

            DB::commit();

            return redirect()->route('pkl')->with('success', 'Data PKL berhasil dihapus dan status siswa diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pkl')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
