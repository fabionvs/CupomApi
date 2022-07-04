<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Passport;
use Validator;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['googleLoginUrl', 'loginCallback', 'login', 'register']]);
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
        //return Redirect::to('cupomapp://?token='.$token);
        return response('<script>window.location.replace("cupomapp://?token='.$token.'");</script>');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token_time = now()->addHours(24);
        Passport::personalAccessTokensExpireIn($token_time);
        $user = auth()->user();
        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(compact('token', 'user', 'token_time'));
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'username' => $request->input('email'),
            'nm_nome' => $request->input('nm_nome'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        $image = $request->input("avatar");  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = $user->id.'.'.'png';
        Storage::disk('public')->put($imageName, base64_decode($image));

        $empresa = Empresa::create([
            'nm_nome' => $request->input('nm_nome'),
             'nr_cnpj' => $request->input('nr_cnpj'),
             'logo' => 'https://api.zenyv.com/images/'.$imageName,
             'user_id' => $user->id
        ]);

        $token_time = now()->addHours(24);
        Passport::personalAccessTokensExpireIn($token_time);
        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(compact('token', 'user', 'token_time'));
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
