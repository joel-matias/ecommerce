<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;

    public $family_id;

    public $options;

    public $selectedFeatures = [];

    public $orderBy = 1;

    public function mount()
    {
        $this->options = Option::whereHas('products.subcategory.category', function ($query) {
            $query->where('family_id', $this->family_id);
        })
            ->with([
                'features' => function ($query) {
                    $query->whereHas('variants.product.subcategory.category', function ($query) {
                        $query->where('family_id', $this->family_id);
                    });
                },
            ])
            ->get()->toArray();
    }

    public function render()
    {

        $products = Product::whereHas('subcategory.category', function ($query) {
            $query->where('family_id', $this->family_id);
        })
            ->when($this->orderBy == 1, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->when($this->orderBy == 2, function ($query) {
                $query->orderBy('price', 'desc');
            })
            ->when($this->orderBy == 3, function ($query) {
                $query->orderBy('price', 'asc');
            })
            ->when($this->selectedFeatures, function ($query) {
                $query->whereHas('variants.features', function ($query) {
                    $query->whereIn('features.id', $this->selectedFeatures);
                });
            })
            ->paginate(12);

        return view('livewire.filter', compact('products'));
    }
}
