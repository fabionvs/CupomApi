<?php

namespace App\Http\Repository;

use App\Models\Filial;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class FilialRepository
{

    public function listPublic(Request $request, $paginate = true)
    {
        $filiais = Filial::select(
        DB::raw("*, ROUND(
            3959 * ACOS(
              COS(RADIANS(?)) *
              COS(RADIANS(latitude)) *
              COS(RADIANS(longitude) - RADIANS(?)) +
              SIN(RADIANS(?)) * SIN(RADIANS(latitude))
            ) * 1.6
          ,1)  AS km_away")
        )
        ->with('empresa')
        ->has('promocoes')
        //->having("km_away", "<", "?")
        ->orderBy("km_away")
        ->setBindings([$request->input('latitude'), $request->input('longitude'), $request->input('latitude')]);
         if($request->input('nm_categoria') !== ""){
            $filiais->where('nm_categoria', 'LIKE', '%'.$request->input('nm_categoria')."%");
        }
        return $filiais->get();
    }

    public function show($id)
    {
        $cargo = Filial::where('id', $id)->first();
        return $cargo;
    }

    public function update($id, $request)
    {
        $cargo = Filial::where('id', $id)->first();
        $cargo->update([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'nm_categoria' => $request->input('nm_categoria'),
            'ds_endereco' => $request->input('ds_endereco')
        ]);
        return $cargo;
    }

    public function create(Request $request)
    {
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $cargo = Filial::create([
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'nm_categoria' => $request->input('nm_categoria'),
            'ds_endereco' => $request->input('ds_endereco'),
            'empresa_id' => $empresa->id
        ]);
        return $cargo;
    }

    public function listUserFiliais($id)
    {
        $filiais = Filial::whereHas('empresa.user', function ($query) {
            return $query->where('id', Auth::user()->id);
        })
        ->where('st_ativo', true)
        ->paginate(15);
        return $filiais;
    }


}
