<?php

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('prueba', function () {
//     $product = Product::find(150);

//     $features = $product->options->pluck('pivot.features');

//     $combinaciones = generarCombinaciones($features);

//     $product->variants()->delete();

//     foreach ($combinaciones as $combinacion) {
//         $variant = Variant::create([
//             'product_id' => $product->id,
//         ]);

//         $variant->features()->attach($combinacion);
//     }

// });

// function generarCombinaciones($arrays, $indece = 0, $combinaciones = [])
// {
//     if ($indece == count($arrays)) {
//         return [$combinaciones];
//     }

//     $resultado = [];

//     foreach ($arrays[$indece] as $item) {
//         $combinacinTemporal = $combinaciones;
//         $combinacinTemporal[] = $item['id'];

//         $resultado = array_merge($resultado, generarCombinaciones($arrays, $indece + 1, $combinacinTemporal));
//     }

//     return $resultado;

// }
