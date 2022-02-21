<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\URL;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        config(['app.url' => env('APP_URL') . '/api/v1/']);
        URL::forceRootUrl(env('APP_URL') . '/api/v1/');
    }

    /**
     * Set the currently logged in user for the application.
     *
     * @return Tests\TestCase $this
     */
    protected function login(): TestCase
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

        $token = $response->json('data.token');
        $this->withToken($token);

        return $this;
    }
}
