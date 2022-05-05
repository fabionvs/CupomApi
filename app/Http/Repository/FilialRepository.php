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
        //->having("km_away", "<", "?")
        ->orderBy("km_away")
        ->setBindings([$request->input('latitude'), $request->input('longitude'), $request->input('latitude')])
        ->get();
        return $filiais;
    }

    public function show($id)
    {
        $cargo = Filial::where('id', $id)->first();
        return $cargo;
    }

    public function create(Request $request)
    {

        $cargo = Filial::create($request->all());
        return $cargo;
    }

    public function update(Request $request, $id)
    {
        $cargo = Filial::where('id', $id)->update($request->all());
        return $cargo;
    }

    public function destroy($id)
    {
        $cargo = Filial::where('id', $id)->first();
        $cargo->st_cargo = false;
        $cargo->save();
        return $cargo;
    }
}
