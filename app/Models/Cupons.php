<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupons extends Model
{
    use HasFactory;

    protected $table = "tb_cupons";

    protected $fillable = [
        'cd_cupom',
        'st_ativo',
        'st_consumido',
        'dt_consumido',
        'dt_user',
        'promocao_id',
        'user_id',
    ];

    public function promocao()
    {
        return $this->belongsTo(Promocao::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
