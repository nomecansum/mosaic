<?php

namespace App\Models;

use App\Models\niveles_acceso;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function users(){

        return $this->belongsTo(users::class);
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
    protected $primaryKey = 'id_cliente';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps =false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'id_cliente',
                  'nom_cliente',
                  'token_1uso',
                  'img_logo',
                  'locked'


                  /* 'id_cliennte',
                  'nom_cliente',
                  'nom_contacto',
                  'img_logo',
                  'val_apikey',
                  'token_1uso',
                  'tel_cliente',
                  'CIF',
                  'fec_borrado',
                  'mca_appmovil',
                  'mca_vip',
                  'locked',
                  'cod_tipo_cliente' */
              ];


}
