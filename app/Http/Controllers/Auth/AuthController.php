<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Passport;
use Validator;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'checkUser']]);
        $this->userService = $userService;
    }


    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //dd($request->all());
        if (empty($request->input('username')) || empty($request->input('password'))) {
            return response()->json([
                "erro" => true,
                "messagem" => "Usuário ou Senha em branco",
            ]);
        }

        $login_user = $request->input('username');
        $password = $request->input('password');

        //Verifica se o usuário existe

        $response = Http::post('https://api-ldap-master.dpu.def.br/public/api/login', [
            'user' => $request->username,
            'password' => $request->password
        ]);

        $return = $response->object();

        if ($return->erro === true) {
            return response()->json([
                "erro" => true,
                "messagem" => "Usuário ou senha inválido",
            ]);
        }
        $ldap =  $this->searchUser($login_user, $password);
        $nomeCompleto = $ldap->data->{0}->cn->{0}; //Nome Completo
        $nomeUnidade = null;
        $idUnidade = null;
        if (isset($ldap->data->{0}->userprincipalname->{0})) {
            $email = $ldap->data->{0}->userprincipalname->{0}; //Nome Email
        } else {
            $email = null;
        }
        if (isset($ldap->data->{0}->ipphone->{0})) {
            $dataNasc = $ldap->data->{0}->ipphone->{0}; //Data nascimento
        } else {
            $dataNasc = null;
        }
        if (isset($ldap->data->{0}->pager->{0})) {
            $cpf = $ldap->data->{0}->pager->{0}; //cpf */ */
        } else {
            $cpf = null;
        }
        $user = User::where('username', $login_user)->first();
        if(!$user){
            $user = User::create([
                'username' => $login_user,
                'nm_nome' => $nomeCompleto,
                'nm_email' => $email,
                'nm_ul' => $nomeUnidade,
                'cd_ul' => $idUnidade,
                'dt_aniversario' => $dataNasc,
                'cd_cpf' => $cpf,
                'ldap' => json_encode((array) $ldap->data->{0})
            ]);
        }
        $user->ldap = json_encode((array) $ldap->data->{0});
        $user->save();
        $token_time = now()->addHours(8);
        Passport::personalAccessTokensExpireIn($token_time);
        $token = $user->createToken('MyApp')->accessToken;
        $user->makeHidden(['ldap']);
        return response()->json(compact('token', 'user', 'token_time'));
    }



    public function register(RegisterRequest $request)
    {
        $response = $this->userService->register($request);
        return response()->json($response, $response['code']);
    }

    public function searchUser($login_user, $password)
    {

        $response = Http::post('https://api-ldap-master.dpu.def.br/public/api/searchUser', [
            'user' => $login_user,
            'password' => $password,
            'loginSearch' => $login_user,
        ]);

        $informacoes = $response->object();

        if ($informacoes->erro == 'false') {
            return $informacoes;

        } else {
            return null;
        }
    }


    public function me()
    {
        return response()->json(auth('api')->user());
    }


    public function checkUser()
    {
        $user = auth('api')->user();
        if ($user) {
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['user' => null]);
        }
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
