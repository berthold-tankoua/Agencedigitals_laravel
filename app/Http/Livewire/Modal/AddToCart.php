<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;

class AddToCart extends Component
{
    public $product_id=0;
    public function getId($id){
        $this->product_id= $id;

    }
    public function render()
    {
        return view('livewire.modal.add-to-cart');
    }
}
