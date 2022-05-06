<?php

namespace App\Http\Controllers;

use App\Http\Services\PromocaoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PromocaoController extends Controller
{
    public function __construct(PromocaoService $promocaoService)
    {
        $this->promocaoService = $promocaoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublic(Request $request)
    {
        $cargo = $this->promocaoService->showPublic($request);
        return $cargo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pegar(Request $request)
    {
        $cargo = $this->promocaoService->pegar($request);
        return $cargo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userCupons(Request $request)
    {
        $cargo = $this->promocaoService->userCupons($request);
        return $cargo;
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPromocao(Request $request)
    {
        $cargo = $this->promocaoService->createPromocao($request);
        return $cargo;
    }

}
