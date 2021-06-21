<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barbershop;

class Banner extends Model
{
    protected $table = 'banner';
    protected $fillable = ['picture','barbershop_id'];

    public function barbershop()
    {
      return $this->belongsTo(Barbershop::class);
    }
}
