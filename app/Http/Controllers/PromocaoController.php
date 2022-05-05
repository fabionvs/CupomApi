<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PromocaoController extends Controller
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
    public function checkUsername(Request $request)
    {
        try {
            $users = $this->user->checkUsername($request);
            return ['response' => $users, 'code' => 200];
        } catch (\Exception $ex) {
            \Log::error($ex);
            return ['response' => $ex->getMessage(), 'code' => $ex->getCode()];
        }
    }

}
