<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $table = "adress";
    protected $fillable = ['slug_adress'];

    public function getAdresses()
    {
        $adress = Adress::all();
        return $adress;
    }
}
