<?php

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;

    public function mount()
    {
        $this->addresses = Address::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
