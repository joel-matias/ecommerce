<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'value',
        'description',
        'option_id',
    ];

    // Relacion uno a muchos inversa
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    // Relacion muchos a muchos
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }
}
