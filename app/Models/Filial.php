<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;
    protected $table = "tb_filial";

    protected $fillable = [
        'ds_endereco',
        'latitude',
        'longitude',
        'st_ativo',
        'nm_categoria',
        'empresa_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function promocoes()
    {
        return $this->hasMany(Promocao::class);
    }
}
