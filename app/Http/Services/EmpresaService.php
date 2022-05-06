<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Repository\EmpresaRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\CargoRequest;

class CargoService
{
    public function __construct(EmpresaRepository $empresaRepository)
    {
        $this->empresaRepository = $empresaRepository;
    }

    public function createEmpresa(CargoRequest $request)
    {
        $cargo = $this->empresaRepository->createEmpresa($request);
        return $cargo;
    }


}
