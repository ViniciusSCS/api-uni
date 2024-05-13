<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->all();

        if (Auth::attempt(['email' => strtolower($data['email']), 'password' => $data['password']])) {
            $user = Auth::user();

            if($user->deleted_at != null){
                return ['status' => true, 'message' => 'Usuário inexistente, realize o cadastro, ou fale com o Administrador!'];
            }

            $user->token = $user->createToken($user->email)->accessToken;

            return ['status' => true, 'message' => 'Usuário logado com sucesso!', "usuario" => $user];
        } else {
            return ['status' => false, 'message' => 'Usuário ou senha incorretos!'];
        }
    }
}
