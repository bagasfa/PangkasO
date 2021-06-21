<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\History;
use App\Roles;
use App\Identity;
use App\Barbershop;

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'address',
        'phone_number',
        'avatar',
        'identity',
        'id_role'
    ];

    public function roles()
    {
      return $this->belongsTo(Roles::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function identity()
    {
        return $this->hasOne(Identity::class);
    }

    public function barbershop()
    {
        return $this->hasOne(Barbershop::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
