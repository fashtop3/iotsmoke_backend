<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['appkey', 'ip', 'location'];

    public function signal()
    {
        return $this->hasOne('App\Signal');
    }

    public function connections()
    {
        return $this->hasMany('App\Connections');
    }
}
