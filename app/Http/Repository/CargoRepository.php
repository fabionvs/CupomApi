<?php

namespace App\Http\Repository;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoRepository
{

    public function list(Request $request, $paginate = true)
    {
        $cargo = Cargo::orderBy('id');
        if ($request->input('nm_nome')) {
            $cargo->where('nm_nome', 'LIKE', '%' . $request->input('nm_nome') . '%');
        }
        if ($request->input('st_cargo')) {
            $cargo->where('st_cargo', $request->input('st_cargo'));
        }
        if ($paginate) {
            return $cargo->paginate(15);
        } else {
            return $cargo->get();
        }
    }

    public function show($id)
    {
        $cargo = Cargo::where('id', $id)->first();
        return $cargo;
    }

    public function create(Request $request)
    {

        $cargo = Cargo::create($request->all());
        return $cargo;
    }

    public function update(Request $request, $id)
    {
        $cargo = Cargo::where('id', $id)->update($request->all());
        return $cargo;
    }

    public function destroy($id)
    {
        $cargo = Cargo::where('id', $id)->first();
        $cargo->st_cargo = false;
        $cargo->save();
        return $cargo;
    }
}
