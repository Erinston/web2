<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Frase extends Model
{
    use HasFactory;
    
	  protected $fillable = [
		    	'title' ,'body',
	  ];

    protected static function booted()
    {
      static::deleting(function (Frase $frase) {
        log::channel('stderr')->info('Evento FraseDeletada.. '.$frase->id);
        Storage::disk('public')->delete($frase->image->path);
      });
    }


	  public function user()
        {

    	return $this->belongsTo('App\Models\User');

        }

        public function image()
        {
        	return $this->hasOne('App\Models\Image');

         }

         public function generos()
         {
            return $this->belongsToMany('App\Models\Genero')->withTimestamps();
         }
}
