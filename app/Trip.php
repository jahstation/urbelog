<?php

namespace Urbelog;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inizio', 'fine','durata','co2',
        'percorso','puntiAttribuiti','user_id',
        'vehicle_id','ztl_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function ztl()
    {
        return $this->belongsTo(Ztl::class);
    }
}
