<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CupomService;

class CupomController extends Controller
{
    public function __construct(CupomService $cupomService)
    {
        $this->cupomService = $cupomService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCupom(Request $request)
    {
        $cargo = $this->cupomService->checkCupom($request);
        return $cargo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userCupons(Request $request)
    {
        $cargo = $this->cupomService->userCupons($request);
        return $cargo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consumirCupons(Request $request)
    {
        $cargo = $this->cupomService->consumirCupons($request);
        return $cargo;
    }

}
