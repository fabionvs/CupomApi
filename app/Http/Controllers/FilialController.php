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
    public function createFilial(CargoRequest $request)
    {
        $cargo = $this->filialService->createFilial($request);
        return $cargo;
    }


}
