<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $fillable = ['device_id', 'sense'];

    public function device()
    {
        return $this->belongsTo('App\Device');
    }
}
