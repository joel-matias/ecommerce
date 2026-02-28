<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type = '';

    public $description = '';

    public $district = '';

    public $reference = '';

    public $receiver = 1;

    public $receiver_info = [];

    public $default = false;
}
