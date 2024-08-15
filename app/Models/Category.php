<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function materiales()
    {
        return $this->hasMany(Material::class, 'categoria_id');
    }
}
