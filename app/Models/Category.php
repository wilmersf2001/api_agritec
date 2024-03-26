<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tb_categories';

    protected $fillable = [
        'nombre',
        'descripcion',
        'icono',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
