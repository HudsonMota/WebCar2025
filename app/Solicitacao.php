<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = "vehiclerequests";
    protected $fillable = ['solicitante'];

    // Relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Altere 'user_id' se o nome do campo for diferente
    }

    // Relação com o modelo Sector
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'setorsolicitante'); // Altere 'setorsolicitante' se o nome do campo for diferente
    }
}
