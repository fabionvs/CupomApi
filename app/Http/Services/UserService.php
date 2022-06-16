<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Repository\CupomRepository;
use App\Http\Repository\PromocaoRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\AtoRequest;

class UserService
{
    public function __construct(CupomRepository $cupomRepository, PromocaoRepository $promocaoRepository)
    {
        $this->cupomRepository = $cupomRepository;
        $this->promocaoRepository = $promocaoRepository;
    }

    public function dashboard(Request $request)
    {
        $userCupons = $this->cupomRepository->userCupons($request, true);
        $usedCupons = $this->cupomRepository->userUsedCupons($request, false);
        $pctUsed = (100 * $usedCupons) / $userCupons;
        $consumedCupons = $this->cupomRepository->userConsumedCupons($request);
        $pctConsumed = (100 * $consumedCupons) / $userCupons;
        return response()->json([
            'cupons' => $userCupons,
            'cupons_used' => $usedCupons,
            'cupons_used_pct' => round($pctUsed),
            'cupons_consumed' => $consumedCupons,
            'cupons_consumed_pct' => round($pctConsumed),
        ]);
    }

}
