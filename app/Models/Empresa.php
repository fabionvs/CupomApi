<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = "tb_empresa";

    protected $fillable = [
        'nm_nome',
        'nr_cnpj',
        'logo',
        'user_id'
    ];
}
