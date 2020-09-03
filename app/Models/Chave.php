<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chave extends Model
{
    protected $fillable = [
    	'sala',
    	'situacao',
    	'id_porteiro',
    	'user_id'
    ];

    public function porteiro()
    {
    	return $this->hasOne('App\Models\Porteiro','id','id_porteiro');
    }

    public function aula()
    {
        return $this->hasMany('App\Models\Aula');
    }
}
