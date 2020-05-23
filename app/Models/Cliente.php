<?php

namespace App\Models;

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

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'nom_cliente',
                  'nom_contacto',
                  'tel_cliente'
              ];


}
