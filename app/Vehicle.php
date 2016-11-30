<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $fillable = [
        'tipo', 'modello',
        'marca','targa',
        'note','euro',
        'tipoAlimentazione'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
