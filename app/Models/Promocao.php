<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Promocao extends Model
{
    use HasFactory;

    protected $table = "tb_promocao";

    protected $fillable = [
        'nm_nome',
        'cd_cupom',
        'nr_porcentagem',
        'st_ativo',
        'dt_vencimento',
        'filial_id'
    ];

    public function cuponsAtivos()
    {
        return $this->hasMany(Cupons::class)->where('user_id', null)->where('st_consumido', false);
    }

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    public function cupons()
    {
        return $this->hasMany(Cupons::class);
    }

}
