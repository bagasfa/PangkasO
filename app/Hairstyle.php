<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
use App\Barbershop;
use App\Rating;

class Hairstyle extends Model
{   
    use Rateable;
    protected $table = 'hairstyle';
    protected $fillable = ['images','name','gender','price','deskripsi','barbershop_id'];

    public function barbershop(){
        return $this->belongsTo(Barbershop::class);
    }

    public function rating()
    {
      return $this->hasMany(Rating::class);
    }
}
