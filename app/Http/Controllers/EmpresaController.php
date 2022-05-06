<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmpresaController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmpresa(Request $request)
    {
        $cargo = $this->promocaoService->createEmpresa($request);
        return $cargo;
    }

}
