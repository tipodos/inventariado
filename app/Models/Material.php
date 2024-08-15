<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    
    public function categoria()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }
}
