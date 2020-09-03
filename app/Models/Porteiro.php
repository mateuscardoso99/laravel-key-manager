<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porteiro extends Model
{
    protected $fillable = ['nome','situacao','user_id'];
}
