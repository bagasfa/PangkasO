<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barbershop;

class Hairstyle extends Model
{
    protected $table = 'hairstyle';
    protected $fillable = ['images','name','gender','price','deskripsi','barbershop_id'];

    public function barbershop(){
        return $this->belongsTo(Barbershop::class);
    }
}
