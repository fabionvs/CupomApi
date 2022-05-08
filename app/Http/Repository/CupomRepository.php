<?php

namespace App\Http\Repository;

use App\Models\Cupons;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CupomRepository
{

    public function empresaCupons(Request $request)
    {
        $cupom = Cupons::with('promocao')
        ->with('user')
        ->where('cd_cupom', $request->input('cd_cupom'))
        ->whereHas('promocao.filial.empresa.user', function ($query) {
            return $query->where('id', Auth::user()->id);
        })
        ->first();
        return $cupom;
    }

    public function consumirCupons(Request $request)
    {
        $cupom = Cupons::with('promocao')
        ->with('user')
        ->where('cd_cupom', $request->input('cd_cupom'))
        ->whereHas('promocao.filial.empresa.user', function ($query) {
            return $query->where('id', Auth::user()->id);
        })
        ->whereHas('promocao', function ($query) {
            return $query->where('dt_vencimento', '<' , Carbon::now());
        })
        ->whereNotNull('user_id')
        ->first();

        if($cupom){
            $cupom->st_consumido = 1;
            $cupom->dt_consumido = Carbon::now();
            $cupom->save();
        }
        return $cupom;
    }


    public function userCupons(Request $request)
    {
        $cupom = Cupons::with('promocao')
        ->whereHas('promocao.filial.empresa.user', function ($query) {
            return $query->where('id', Auth::user()->id);
        })
        ->count();
        return $cupom;
    }

    public function userUsedCupons(Request $request)
    {
        $cupom = Cupons::with('promocao')
        ->whereHas('promocao.filial.empresa.user', function ($query) {
            return $query->where('id', Auth::user()->id);
        })
        ->whereNotNull('user_id')
        ->count();
        return $cupom;
    }

    public function userConsumedCupons(Request $request)
    {
        $cupom = Cupons::with('promocao')
        ->whereHas('promocao.filial.empresa.user', function ($query) {
            return $query->where('id', Auth::user()->id);
        })
        ->whereNotNull('user_id')
        ->where('st_consumido', true)
        ->count();
        return $cupom;
    }

}
