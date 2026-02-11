<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Language extends Component
{
    public $language ="English";
    public function French(){
        $this->language="French";
    }
 
    public function English(){
        session()->get('language');
        session()->forget('language');
        Session::put('language','english');
    }
    public function render()
    {
        return view('livewire.frontend.language');
    }
}
