<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;

    public $newAddress = true;

    public CreateAddressForm $createAddress;

    public function mount()
    {
        $this->addresses = Address::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
