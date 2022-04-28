<?php

namespace App\Http\Controllers;

use App\Http\Services\CityService;
use App\Http\Services\PlansService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

class PlansController extends Controller
{
    public function __construct(PlansService $service, ResponseFactory $response)
    {
        $this->planService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getPlans(Request $request)
    {
        try {
 $plans = $this->planService->getPlans($request);
            return response()->json([
                'data' => $plans
            ], 200);
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => $ex->getCode()
            ]);
        }
    }
R
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $plans = $this->planService->listar($request);
            return response()->json([
                'data' => $plans
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $plans = $this->planService->store($request);
            return response()->json([
                'data' => $plans
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $plan = $this->planService->show($id);
            return response()->json([
                'data' => $plan
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Empresa $plans
     * @return JsonResponse
     */
    public function update(Request $request, Empresa $plans)
    {
        try {
            $plan = $this->planService->update($request, $plans);
            return response()->json([
                'data' => $plan
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Empresa $plans
     * @return JsonResponse
     */
    public function destroy(Request $request, Empresa $plans)
    {
        try {
            $plan = $this->service->destroy($plans);
            return response()->json([
                'data' => $this->planService->destroy($request)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }

}
