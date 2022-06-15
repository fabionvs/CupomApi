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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargo = $this->filialService->show($id);
        return $cargo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $cargo = $this->filialService->update($id, $request);
        return $cargo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cargo = $this->filialService->create($request);
        return $cargo;
    }

    /**
     * Lista filiais da empresa
     *
     * @return \Illuminate\Http\Response
     */
    public function listUserFiliais(Request $request)
    {
        $cargo = $this->filialService->listUserFiliais($request);
        return $cargo;
    }

}
