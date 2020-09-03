<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = [
    	'nome',
    	'curso',
    	'situacao',
    	'id_professor',
    	'user_id'
    ];

    public function professor()
    {
    	return $this->belongsTo('App\Models\Professor','id_professor');
    }
}
