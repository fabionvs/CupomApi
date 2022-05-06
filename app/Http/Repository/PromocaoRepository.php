<?php

namespace App\Http\Repository;

use App\Models\Promocao;
use App\Models\Cupons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PromocaoRepository
{

    public function showPublic(Request $request, $paginate = true)
    {
        $filiais = Promocao::where('filial_id', $request->input('filial_id'))
        ->where('st_ativo', true)
        ->has('cuponsAtivos')
        ->orderBy("dt_vencimento", "ASC")
        ->get();
        return $filiais;
    }

    public function pegar(Request $request)
    {
        $checkUserHasCupons = Cupons::where('user_id', Auth::user()->id)
        ->whereDate('dt_user', Carbon::today())
        ->first();
        if($checkUserHasCupons == null){
            $cupom = Cupons::where('promocao_id', $request->input('promocao_id'))
            ->where('user_id', null)
            ->orderBy('id', 'ASC')
            ->first();
            $cupom->update([
                'user_id' => Auth::user()->id,
                'dt_user' => Carbon::now()->format("Y-m-d H:i:s"),
            ]);
            return $cupom;
        }else{
            return response()->json([
                'error' => true
            ]);
        }
    }

    public function userCupons(Request $request)
    {
        $userCupons = Cupons::where('user_id', Auth::user()->id)
        ->with('promocao.filial.empresa')
        ->orderBy('dt_user', "DESC")
        ->get();
        return $userCupons;
    }

    public function createPromocao(Request $request)
    {
        $promocao = Promocao::create($request->all());

        for ($i = 1; $i <= $request->input('nr_cupons'); $i++) {
            $cupons[$i] = Cupons::create([
                'cd_cupom' => substr(strtoupper(uniqid()), 0, 6),
                'st_ativo' => true,
                'st_consumido' => false,
                'promocao_id' => $promocao[1]['id']
            ]);
        }
    }
}
