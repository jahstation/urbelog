<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ztl extends Model
{
    //
    protected $fillable =
        [
            'città',
            'file'
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
