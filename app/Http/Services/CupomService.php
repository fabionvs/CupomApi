<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Repository\CupomRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\CargoRequest;

class CupomService
{
    public function __construct(CupomRepository $cupomRepository)
    {
        $this->cupomRepository = $cupomRepository;
    }

    public function checkCupom(Request $request)
    {
        $cargo = $this->cupomRepository->checkCupom($request);
        return $cargo;
    }

    public function userCupons(Request $request)
    {
        $cargo = $this->cupomRepository->userCupons($request);
        return response()->json($cargo);
    }

    public function consumirCupons(Request $request)
    {
        $cargo = $this->cupomRepository->consumirCupons($request);
        return $cargo;
    }

}
