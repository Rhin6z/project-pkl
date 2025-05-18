<?php

namespace App\Livewire\Front\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $userMail;

    public function mount(){
        $this->userMail = Auth::user()->email;
    }
    public function render()
    {
        return view('livewire.front.siswa.index',[
            'siswa'=>Siswa::where('email','=',$this->userMail)->first(),
        ]);
    }
}