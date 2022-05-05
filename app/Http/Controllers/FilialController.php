<?php

namespace App\Http\Controllers;

use App\Http\Services\FilialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilialController extends Controller
{
    public function __construct(FilialService $filialService)
    {
        $this->filialService = $filialService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listPublic(Request $request)
    {
        $cargo = $this->filialService->listPublic($request);
        return $cargo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request)
    {
        $cargo = $this->filialService->create($request);
        return $cargo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargo = $this->filialService->show($id);
        return $cargo;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CargoRequest $request, $id)
    {
        $cargo = $this->filialService->update($request, $id);
        return $cargo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cargo = $this->filialService->destroy($id);
        return $cargo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listCargosAtivos(Request $request)
    {
        $cargo = $this->filialService->listCargosAtivos($request);
        return $cargo;
    }

}
