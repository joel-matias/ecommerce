<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateAddressForm;
use App\Livewire\Forms\Shipping\EditAddressForm;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShippingAddresses extends Component
{
    public $addresses;

    public $newAddress = false;

    public CreateAddressForm $createAddress;

    public EditAddressForm $editAddress;

    public function mount()
    {
        $this->addresses = Address::where('user_id', Auth::id())->get();
        $this->createAddress->receiver_info = [
            'name' => Auth::user()->name,
            'last_name' => Auth::user()->last_name,
            'document_type' => Auth::user()->document_type,
            'document_number' => Auth::user()->document_number,
            'phone' => Auth::user()->phone,
        ];
    }

    public function store()
    {
        $this->createAddress->save();
        $this->addresses = Address::where('user_id', Auth::id())->get();
        $this->newAddress = false;

    }

    public function setDefaultAddress($id)
    {
        $this->addresses->each(function ($address) use ($id) {
            $address->update([
                'default' => $address->id == $id ? true : false,
            ]);
        });
    }

    public function edit($id)
    {
        $address = Address::find($id);

        $this->editAddress->edit($address);
    }

    public function update()
    {
        $this->editAddress->update();

        $this->addresses = Address::where('user_id', Auth::id())->get();

    }

    public function render()
    {
        return view('livewire.shipping-addresses');
    }
}
