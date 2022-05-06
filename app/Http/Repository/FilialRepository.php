<?php

namespace App\Http\Repository;

use App\Models\Filial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function createFilial(Request $request)
    {
        $cargo = Filial::create($request->all());
        return $cargo;
    }

}
