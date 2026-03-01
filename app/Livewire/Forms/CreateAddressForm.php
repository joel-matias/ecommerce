<?php

namespace App\Livewire\Forms;

use App\Enums\TypeOfDocuments;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;
use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type = '';

    public $description = '';

    public $colonia = '';

    public $reference = '';

    public $receiver = 1;

    public $receiver_info = [];

    public $default = false;

    public function rules()
    {
        return [
            'type' => 'required|in:1,2',
            'description' => 'required|string',
            'colonia' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_type' => [
                'required',
                new Enum(TypeOfDocuments::class),
            ],
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',

        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => 'tipo de direccion',
            'description' => 'descripción',
            'colonia' => 'distrito',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre',
            'receiver_info.last_name' => 'apellidos',
            'receiver_info.document_type' => 'tipo de documento',
            'receiver_info.document_number' => 'numero de documento',
            'receiver_info.phone' => 'telefono',
        ];
    }

    public function save()
    {
        $this->validate();

        if (Auth::user()->addresses->count() === 0) {
            $this->default = true;
        }

        Address::create([
            'user_id' => Auth::id(),
            'type' => $this->type,
            'description' => $this->description,
            'colonia' => $this->colonia,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
        ]);

        $this->reset();

        $this->receiver_info = [
            'name' => Auth::user()->name,
            'last_name' => Auth::user()->last_name,
            'document_type' => Auth::user()->document_type,
            'document_number' => Auth::user()->document_number,
            'phone' => Auth::user()->phone,
        ];
    }
}
