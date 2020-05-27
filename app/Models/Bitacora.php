<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bitacora extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bitacora';



    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'id_usuario',
                  'id_modulo',
                  'accion',
                  'status',
                  'fecha'
              ];

}
