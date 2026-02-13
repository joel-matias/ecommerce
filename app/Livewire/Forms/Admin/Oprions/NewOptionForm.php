<?php

namespace App\Livewire\Forms\Admin\Oprions;

use App\Models\Option;
use Livewire\Form;

class NewOptionForm extends Form
{
    public $name;

    public $type = 1;

    public $features = [
        [
            'value' => '',
            'description' => '',
        ],
    ];

    public $openModal = false;

    public function rules()
    {
        $rules = ([
            'name' => 'required',
            'type' => 'required|in:1,2',
            'features' => 'required|array|min:1',
        ]);

        foreach ($this->features as $index => $feature) {
            if ($this->type == 1) {
                $rules['features.'.$index.'.value'] = 'required';
            } else {
                $rules['features.'.$index.'.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
            }
            $rules['features.'.$index.'.description'] = 'required|max:255';
        }

        return $rules;
    }

    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'type' => 'tipo',
            'features' => 'caracteristicas',
            'features.*.value' => 'valores',
            'features.*.description' => 'descripción',
        ];
    }

    public function addFeature()
    {
        $this->features[] = [
            'value' => '',
            'description' => '',
        ];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function save()
    {
        $this->validate();

        $option = Option::create([
            'name' => $this->name,
            'type' => $this->type,

        ]);

        foreach ($this->features as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],

            ]);
        }

        $this->reset();
    }
}
