<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\{
    DatabaseTransactions,
    RefreshDatabase
};
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function testCreateUser(): void
    {
        User::create([
            'name' => 'Test of Create',
            'email' => 'test@test.com',
            'password' => bcrypt(123456789)
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Test of Create']);
    }
}
