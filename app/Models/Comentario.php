<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'comentario', 'created_at'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}