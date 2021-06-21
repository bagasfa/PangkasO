<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Banner;

class Barbershop extends Model
{
    protected $table = 'barbershop';
    protected $fillable = ['name','service_preferences','address','phone_number','owner_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function banner()
    {
      return $this->hasOne(Banner::class);
    }
}
