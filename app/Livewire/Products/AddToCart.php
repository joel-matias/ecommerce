<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCart extends Component
{
    public $product;

    public $qty = 1;

    public $selectedFeatures = [

    ];

    public function mount()
    {
        $this->selectedFeatures = $this->product->variants->first()->features->pluck('id','option_id')->toArray();
    }

    #[Computed]
    public function variant()
    {
        return $this->product->variants->filter(function ($variant) {
            return ! array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();
    }

    public function add_to_cart()
    {
        Cart::instance('shopping');

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->product->image,
                'sku' => $this->variant->sku,
                'features' => Feature::whereIn('id', $this->selectedFeatures)
                    ->pluck('description', 'id')->toArray(),
            ],
        ]);

        if (Auth::check()) {
            Cart::store(Auth::id());
        }

        $this->dispatch('cartUpdated', Cart::count());

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien echo!',
            'content' => 'El producto se agrego correctamente',
        ]);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
