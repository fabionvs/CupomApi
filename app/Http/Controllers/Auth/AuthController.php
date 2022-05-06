<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Passport;
use Validator;
use Socialite;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['googleLoginUrl', 'loginCallback']]);
    }


    public function googleLoginUrl()
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function loginCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $googleUser->id)->first();

        if ($user == null){
            $user = User::create([
                'nm_nome' => $googleUser->name,
                'email' => $googleUser->email,
                'username' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => encrypt(rand())
            ]);
        }

        $token_time = now()->addYears(5);
        Passport::personalAccessTokensExpireIn($token_time);
        $token = $user->createToken('MyApp')->accessToken;
        //return response()->json(compact('token', 'user', 'token_time'));
        //echo '<script>window.location.replace("exp://192.168.15.2:19000?token='.$token.');</script>';die;
        return Redirect::to('exp://192.168.15.2:19000?token='.$token);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
