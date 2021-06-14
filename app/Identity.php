<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Identity extends Model
{
    protected $table = 'identity';
    protected $fillable = ['nik','ktp','ktp_user','user_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
