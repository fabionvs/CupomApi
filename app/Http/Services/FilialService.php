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

    public function show($id)
    {
        $cargo = $this->filialRepository->show($id);
        return $cargo;
    }

    public function create(Request $request)
    {
        $cargo = $this->filialRepository->create($request);
        return $cargo;
    }

    public function update(Request $request, $id)
    {
        $cargo = $this->filialRepository->update($request, $id);
        return $cargo;
    }

    public function destroy($id)
    {
        $cargo = $this->filialRepository->destroy($id);
        return $cargo;
    }

    public function listCargosAtivos(Request $request)
    {
        $request->input('st_cargo', true);
        $cargo = $this->filialRepository->list($request, false);
        return $cargo;
    }
}
