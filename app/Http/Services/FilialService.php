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

    public function show($id)
    {
        $cargo = $this->filialRepository->show($id);
        return $cargo;
    }

    public function update($id, $request)
    {
        $cargo = $this->filialRepository->update($id, $request);
        return $cargo;
    }

    public function listPublic(Request $request)
    {

        $cargo = $this->filialRepository->listPublic($request);
        return $cargo;
    }

    public function listCategories(Request $request)
    {

        $cargo = $this->filialRepository->listCategories($request);
        return $cargo;
    }

    public function listUserFiliais(Request $request)
    {

        $cargo = $this->filialRepository->listUserFiliais($request, true);
        return $cargo;
    }

    public function create(Request $request)
    {
        $cargo = $this->filialRepository->create($request);
        return $cargo;
    }

}
