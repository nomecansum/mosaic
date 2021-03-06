<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class niveles_acceso extends Model
{

    public function usuarios(){
        return $this->hasMany(users::class);
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'niveles_acceso';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'cod_nivel';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'val_nivel_acceso',
                  'des_nivel_acceso',
                  'id_cliente'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];




}
