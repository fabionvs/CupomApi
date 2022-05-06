<?php

namespace App\Http\Repository;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaRepository
{

    public function createEmpresa(Request $request)
    {
        $cargo = Empresa::create($request->all());
        return $cargo;
    }

}
