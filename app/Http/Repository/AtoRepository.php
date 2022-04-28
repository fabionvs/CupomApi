<?php

namespace App\Http\Repository;

use App\Models\Ato;
use Illuminate\Http\Request;

class AtoRepository
{

    public function list(Request $request, $paginate = true)
    {
        $ato = Ato::with('tipoAto')->orderBy('id');
        if ($request->input('ds_descricao')) {
            $ato->where('ds_descricao', 'LIKE', '%' . $request->input('ds_descricao') . '%');
        }
        if ($request->input('st_ato')) {
            $ato->where('st_ato', $request->input('st_ato'));
        }
        if ($paginate) {
            return $ato->paginate(15);
        } else {
            return $ato->get();
        }
    }

    public function show($id)
    {
        $ato = Ato::with('tipoAto')->with('veiculoPublicacao')->where('id', $id)->first();
        return $ato;
    }

    public function create(Request $request)
    {
        $ato = Ato::create($request->all());
        return $ato;
    }

    public function update(Request $request, $id)
    {
        $ato = Ato::where('id', $id)->first();
        $ato->update($request->all());
        return $ato;
    }

    public function destroy($id)
    {
        $ato = Ato::where('id', $id)->first();
        $ato->st_ato = false;
        $ato->save();
        return $ato;
    }
}
