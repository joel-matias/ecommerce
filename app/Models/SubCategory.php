<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    // Relacion uno a muchos inversa
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relacion uno a muchos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
