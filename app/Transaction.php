<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use App\User;
use App\Barbershop;
use App\Hairstyle;

class Transaction extends Model
{
    use AutoNumberTrait;

    protected $table = 'transactions';
    protected $fillable = ['no_antri','user_id','hairstyle_id','barbershop_id','jenis_layanan','harga','status','jam_booking','pesan','lokasi','hairstyle_rating','barbershop_rating'];

    public function getAutoNumberOptions()
    {
        return [
            'no_antri' => [
                'format' => function () {
                    return $this->jenis_layanan.'/'.date('Y.m.d').'/OD/?'; 
                },
                'length' => 3
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barbershop()
    {
        return $this->belongsTo(Barbershop::class);
    }

    public function hairstyle()
    {
        return $this->belongsTo(Hairstyle::class);
    }

}
