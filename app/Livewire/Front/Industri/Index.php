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

    protected $queryString = [
        'search' => ['except' => ''],
        'bidang_usaha' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingBidangUsaha()
    {
        $this->resetPage();
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
