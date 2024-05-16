<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return ['status' => 200, 'message' => "Usuário encontrado com sucesso!", "usuario" => $user];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function me(Request $request)
    {
        $user = Auth::user();

        return ['status' => true, 'message' => 'Usuário logado!', "usuario" => $user];
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if($user == null){
            return ['status' => 200, 'message' => "Usuário não encontrado!"];
        }

        return ['status' => 200, 'message' => "Usuário encontrado com sucesso!", "usuario" => $user];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $user = User::find($id);

        if($user == null){
            return ['status' => 200, 'message' => "Usuário não encontrado!"];
        }

        if(Auth::user()->id != $user->id){
            return ['status' => 200, 'message' => "Usuário não pode ser atualizado!"];
        }

        $user->update($data);

        return ['status' => 200, 'message' => "Usuário atualizado com sucesso!", "usuario" => $user];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if($user == null){
            return ['status' => 200, 'message' => "Usuário não encontrado!", "usuario" => $user];
        }

        if(Auth::user()->id == $user->id){
            return ['status' => 200, 'message' => "Você não pode se deletar!"];
        }

        if($user->deleted_at != null){
            return ['status' => 200, 'message' => "Usuário já deletado!"];
        }

        $data = [
            'deleted_at' => now()
        ];

        $user->update($data);

        return ['status' => 200, 'message' => "Usuário deletado com sucesso!", "usuario" => $user];
    }
}
