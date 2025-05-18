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
    }

    public function render()
    {
        // Make sure your blade file is at resources/views/livewire/front/pkl/index.blade.php
        return view('livewire.front.pkl.index',[
            'pkls' => $this->search === NULL ?
                        Pkl::latest()->paginate($this->rowPerPage) :
                        Pkl::latest()->whereHas('siswa', function ($query) {
                                                $query->where('nama', 'like', '%' . $this->search . '%');
                                            })
                                    ->orWhereHas('industri', function ($query) {
                                                $query->where('nama', 'like', '%' . $this->search . '%');
                                    })->paginate($this->rowPerPage),

            //mengakses record siswa yang emailnya sama dengan user yang sedang login
            'siswa_login' => Siswa::where('email', '=', $this->userMail)->first(),

            'industris' => Industri::all(),
            'gurus' => Guru::all(),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
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
        $this->siswaId      ='';
        $this->industriId   = '';
        $this->guruId       = '';
        $this->mulai        ='';
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


        DB::beginTransaction();

        try {
            $siswa = Siswa::find($this->siswaId);

            if ($siswa->status_lapor_pkl) {
                // session()->flash('error', 'Transaksi dibatalkan: Siswa sudah melapor.');

                DB::rollBack();
                $this->closeModal();

                return redirect()->route('pkl')->with('error', 'Transaksi dibatalkan: Siswa sudah melapor.');
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
            // session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            $this->closeModal();
            return redirect()->route('pkl')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
