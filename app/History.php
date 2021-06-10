<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['nama','aksi','keterangan','status','user_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
