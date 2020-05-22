<?php

namespace App;

use App\Models\niveles_acceso;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function users(){

        return $this->hasMany(users::class);
}

    public function niveles_acceso(){

        return $this->hasMany(niveles_acceso::class);
}

}
