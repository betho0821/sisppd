<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'observations',
        'beneficiario_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function beneficiario()
    {
        return $this->belongsTo(Beneficiario::class);
    }
}
