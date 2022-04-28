<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeiculoPublicacao extends Model
{
    use HasFactory;

    protected $table = 'tb_veiculo_publicacao';

    protected $fillable = [
        'id',
        'ds_descricao',
        'st_veiculo_publicacao',
        'created_at',
        'updated_at'
    ];

    public function atos()
    {
        return $this->hasMany(Ato::class);
    }

    public function provimento()
    {
        return $this->hasMany(Provimento::class);
    }
}
