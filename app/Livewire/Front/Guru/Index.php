<?php

namespace App\Livewire\Front\Guru;

use App\Models\Guru;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $gender = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'gender' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingGender()
    {
        $this->resetPage();
    }

    public function render()
    {
        $gurus = Guru::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->gender, function ($query) {
                $query->where('gender', $this->gender);
            })
            ->orderBy('nama')
            ->paginate(12);

        return view('livewire.front.guru.index', compact('gurus'));
    }
}
