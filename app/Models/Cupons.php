<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupons extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'nm_nome',
        'dt_aniversario',
        'cpf',
        'email',
    ];
}
