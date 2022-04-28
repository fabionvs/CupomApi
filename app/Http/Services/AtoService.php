<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Repository\AtoRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\AtoRequest;

class AtoService
{
    public function __construct(AtoRepository $atoRepository)
    {
        $this->atoRepository = $atoRepository;
    }

    public function list(Request $request)
    {
        $ato = $this->atoRepository->list($request);
        return $ato;
    }

    public function show($id)
    {
        $ato = $this->atoRepository->show($id);
        return $ato;
    }

    public function create(AtoRequest $request)
    {
        try {
            $ato = $this->atoRepository->create($request);
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
        return $ato;
    }

    public function update(AtoRequest $request, $id)
    {
        $ato = $this->atoRepository->update($request, $id);
        return $ato;
    }

    public function destroy($id)
    {
        $ato = $this->atoRepository->destroy($id);
        return $ato;
    }

    public function listAtosAtivos(Request $request)
    {
        $request->input('st_ato', true);
        $ato = $this->atoRepository->list($request, false);
        return $ato;
    }
}
