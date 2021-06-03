<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Roles extends Model
{

    protected $table = 'roles';
    protected $fillable = ['role_name'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
