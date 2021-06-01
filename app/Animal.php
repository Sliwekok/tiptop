<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animals';

    public function photo()
    {
        return $this->hasOne('App\Photos', 'id_animal', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

}
