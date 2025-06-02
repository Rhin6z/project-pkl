<?php

namespace App\Livewire\Front\Industri;

use App\Models\Industri;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $bidang_usaha = '';

    // Properties for create modal
    public $isOpen = false;
    public $nama;
    public $alamat;
    public $kontak;
    public $email;
    public $website;
    public $bidang_usaha_form;

    protected $queryString = [
        'search' => ['except' => ''],
        'bidang_usaha' => ['except' => ''],
    ];

    protected $rules = [
        'nama' => 'required|string|max:255',
        'alamat' => 'nullable|string|max:500',
        'kontak' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'website' => 'nullable|url|max:255',
        'bidang_usaha_form' => 'required|string|max:255',
    ];

    protected $messages = [
        'nama.required' => 'Nama industri wajib diisi.',
        'nama.max' => 'Nama industri maksimal 255 karakter.',
        'alamat.max' => 'Alamat maksimal 500 karakter.',
        'kontak.max' => 'Kontak maksimal 20 karakter.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 255 karakter.',
        'website.url' => 'Format website tidak valid.',
        'website.max' => 'Website maksimal 255 karakter.',
        'bidang_usaha_form.required' => 'Bidang usaha wajib diisi.',
        'bidang_usaha_form.max' => 'Bidang usaha maksimal 255 karakter.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBidangUsaha()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        try {
            Industri::create([
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'website' => $this->website,
                'bidang_usaha' => $this->bidang_usaha_form,
            ]);

            $this->resetForm();
            $this->isOpen = false;

            session()->flash('message', 'Industri berhasil ditambahkan.');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan industri.');
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
        $this->resetErrorBag();
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->alamat = '';
        $this->kontak = '';
        $this->email = '';
        $this->website = '';
        $this->bidang_usaha_form = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        $bidangUsahaOptions = Industri::distinct()
            ->pluck('bidang_usaha')
            ->filter()
            ->sort()
            ->values();

        $industris = Industri::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('alamat', 'like', '%' . $this->search . '%')
                      ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%');
            })
            ->when($this->bidang_usaha, function ($query) {
                $query->where('bidang_usaha', $this->bidang_usaha);
            })
            ->orderBy('nama')
            ->paginate(12);

        return view('livewire.front.industri.index', compact('industris', 'bidangUsahaOptions'));
    }
}
