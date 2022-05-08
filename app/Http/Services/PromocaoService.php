<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Repository\PromocaoRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\CargoRequest;

class PromocaoService
{
    public function __construct(PromocaoRepository $promocaoRepository)
    {
        $this->promocaoRepository = $promocaoRepository;
    }

    public function userCupons(Request $request)
    {
        $cargo = $this->promocaoRepository->userCupons($request);
        return $cargo;
    }

    public function showPublic(Request $request)
    {
        $cargo = $this->promocaoRepository->showPublic($request);
        return $cargo;
    }

    public function list(Request $request)
    {
        $cargo = $this->promocaoRepository->list($request);
        return $cargo;
    }

    public function pegar(Request $request)
    {
        $cargo = $this->promocaoRepository->pegar($request);
        return $cargo;
    }

    public function createPromocao(Request $request)
    {
        $cargo = $this->promocaoRepository->createPromocao($request);
        return $cargo;
    }
}
