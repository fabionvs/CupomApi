<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Repository\FilialRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\CargoRequest;

class FilialService
{
    public function __construct(FilialRepository $filialRepository)
    {
        $this->filialRepository = $filialRepository;
    }

    public function listPublic(Request $request)
    {

        $cargo = $this->filialRepository->listPublic($request);
        return $cargo;
    }

    public function createFilial(Request $request)
    {
        $cargo = $this->filialRepository->createFilial($request);
        return $cargo;
    }

}
