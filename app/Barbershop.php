<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Hairstyle;

class Barbershop extends Model
{
    protected $table = 'barbershop';
    protected $fillable = ['banner','name','service_preferences','address','phone_number','owner_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function hairstyle(){
      return $this->hasMany(Hairstyle::class);
    }
}
