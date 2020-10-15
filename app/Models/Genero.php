<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    ];

    public function frases()
    {
    	return $this->belongsToMany('App\Models\Frase');
    }

    public function frases_count()
    {
    	return $this->belongsToMany('App\Models\Frase')->count();
    }
}
