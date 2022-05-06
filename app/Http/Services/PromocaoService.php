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

    public function showPublic(Request $request)
    {
        $cargo = $this->promocaoRepository->showPublic($request);
        return $cargo;
    }

    public function pegar(Request $request)
    {
        $promocao = $this->promocaoRepository->pegar($request);
        return $promocao;
    }

    public function userCupons(Request $request)
    {
        $promocao = $this->promocaoRepository->userCupons($request);
        return $promocao;
    }

    public function createPromocao(Request $request)
    {
        $promocao = $this->promocaoRepository->createPromocao($request);
        return $promocao;
    }

}
