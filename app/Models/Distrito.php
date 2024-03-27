<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $table = 'tb_distrito';

    protected $fillable = [
        'id',
        'nombre',
        'provincia_id',
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'distrito_id');
    }
}
