<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
use App\User;
use App\Hairstyle;

class Barbershop extends Model
{
    use Rateable;
    protected $table = 'barbershop';
    protected $fillable = ['banner','name','service_preferences','address','phone_number','owner_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function hairstyle(){
      return $this->hasMany(Hairstyle::class);
    }

    public function rating()
    {
      return $this->hasMany(Rating::class);
    }
}
