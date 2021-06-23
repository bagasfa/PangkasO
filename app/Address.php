<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [ 'detail','desa','kecamatan','kabupaten','provinsi','kode_pos','latitude','longitude'];
}
