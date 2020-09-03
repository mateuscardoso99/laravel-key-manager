<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = [
    	'nome',
    	'graduacao',
    	'situacao',
    	'user_id'
    ];

    public function aluno()
    {
        return $this->hasMany('App\Models\Aluno');
    }
}
