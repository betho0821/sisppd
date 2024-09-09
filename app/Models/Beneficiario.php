<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'colonia',
        'calle',
        'numero',
        'responsable',
        'telefono',
    ];

    public function visitas()
    {
        return $this->hasMany(Visit::class);
    }
}
