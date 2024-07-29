<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function testCreateUser(): void
    {
        $user = User::create([
            'uuid' => (string) Uuid::uuid4(),
            'name' => 'Test of Create',
            'email' => 'test@test.com',
            'password' => bcrypt(123456789)
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Test of Create']);
    }
}
