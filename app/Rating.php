<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Hairstyle;

class Rating extends Model
{
    protected $table = 'ratings';

    public $fillable = ['rating','rateable_id','user_id'];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hairstyle()
    {
        return $this->belongsTo(Hairstyle::class);
    }
}
