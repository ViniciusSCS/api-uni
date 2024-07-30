<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserListTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function testListUser(): void
    {
        Auth::attempt(['email' => strtolower('vinicius@teste.com'), 'password' => 'Teste@!92']);

        $user = Auth::user();

        // Criar um token de API
        $token = $user->createToken('TestToken')->accessToken;

        // Fazer uma requisição GET autenticada
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/user/listar');

        $response->assertStatus(200)
                 ->assertJsonIsObject();
    }
}
