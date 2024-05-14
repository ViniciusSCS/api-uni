<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Exibe a listagem dos usuários cadastrados.
     */
    public function index()
    {
        $user = User::get();

        return ['status' => 200, 'message' => "Usuário encontrado com sucesso!", "usuario" => $user];
    }

    /**
     * Salva os dados do usuário criado no banco de dados.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
        ]);

        return ['status' => 200, 'message' => "Usuário criado com sucesso!", "usuario" => $user];
    }

    /**
     * Visualiza o usuário cadastrado pelo id.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if($user == null){
            return ['status' => 200, 'message' => "Usuário não encontrado!", "usuario" => $user];
        }

        return ['status' => 200, 'message' => "Usuário encontrado com sucesso!", "usuario" => $user];
    }

    /**
     * Atualiza os dados do usuário pelo id, porem o id logado consegue atualizar o próprio dado.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $user = User::find($id);

        if($user == null){
            return ['status' => 200, 'message' => "Usuário não encontrado!", "usuario" => $user];
        }

        $user->update($data);

        return ['status' => 200, 'message' => "Usuário atualizado com sucesso!", "usuario" => $user];
    }

    /**
     * Deleta os dados cadastrados do usuário cadastrado.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete($id);

        return ['status' => 200, 'message' => "Usuário deletado com sucesso!", "usuario" => $user];
    }
}
