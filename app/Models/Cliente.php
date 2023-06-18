<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';

    protected $primaryKey = 'id';

    protected $fillable = ['email', 'nombre', 'telefono'];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}