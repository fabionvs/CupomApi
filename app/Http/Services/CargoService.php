<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Repository\CargoRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\CargoRequest;

class CargoService
{
    public function __construct(CargoRepository $cargoRepository)
    {
        $this->cargoRepository = $cargoRepository;
    }

    public function list(Request $request)
    {
        $cargo = $this->cargoRepository->list($request);
        return $cargo;
    }

    public function show($id)
    {
        $cargo = $this->cargoRepository->show($id);
        return $cargo;
    }

    public function create(CargoRequest $request)
    {
        $cargo = $this->cargoRepository->create($request);
        return $cargo;
    }

    public function update(CargoRequest $request, $id)
    {
        $cargo = $this->cargoRepository->update($request, $id);
        return $cargo;
    }

    public function destroy($id)
    {
        $cargo = $this->cargoRepository->destroy($id);
        return $cargo;
    }

    public function listCargosAtivos(Request $request)
    {
        $request->input('st_cargo', true);
        $cargo = $this->cargoRepository->list($request, false);
        return $cargo;
    }
}
