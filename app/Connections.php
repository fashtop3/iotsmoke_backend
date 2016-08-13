<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connections extends Model
{
    protected $fillable = ['device_id', 'batt'];


    public function setBattAttribute($batt)
    {
        $this->attributes['batt'] = ($batt/1000) . 'v';
    }

    public function device()
    {
        return $this->belongsTo('App\Device');
    }
}
