<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    /**
     * Assert we can obtain JWT for the admin.
     *
     * @return void
     */
    public function test_admin_login(): void
    {
        create(User::class, [
            'email' => 'admin@buckhill.co.uk',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);

        $response = $this->post('admin/login', [
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
        ]);

        $response->assertJsonStructure([
            'success',
            'data' => [
                'token',
            ],
            'error',
            'errors',
            'extra',
        ]);

        $response->assertOk();
    }

    /**
     * Assert we can obtain JWT for the admin.
     *
     * @return void
     */
    public function test_create_admin(): void
    {
        $user = create(User::class, [
            'is_admin' => true,
        ], 'make')->toArray();

        $this->login();

        $response = $this->post('admin/create', $user);

        $response->assertOk();
        $response->assertExactJson([
            'status' => 'success',
        ]);
    }
}
