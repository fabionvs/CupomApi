<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VeiculoPublicacao;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vaga extends Model
{
    use HasFactory;

    protected $table = 'tb_vaga';

    protected $fillable = [
        'id',
        'st_vaga',
        'nr_quantidade',
        'nr_objetivo',
        'ato_id',
        'cargo_id'
    ];

    public function ato()
    {
        return $this->belongsTo(Ato::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function provimentoSemVaga()
    {
        return $this->hasOne(Provimento::class)
        ->where('tipo_provimento_id', null)
        ->where('tipo_ato_id', null)
        ->where('veiculo_publicacao_id', null)
        ->where('servidor_id', null)
        ->with('tipoAto')
        ->with('veiculoPublicacao')
        ->with('vaga')
        ->with('vaga.cargo')
        ->with('vaga.ato')
        ->with('servidor')
        ->orderBy('nr_vaga', 'ASC');
    }
}
