<?php

namespace App\Providers;

use App\Services\Auth\JwtGuard;
use Lcobucci\JWT\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param \Lcobucci\JWT\Configuration $configuration
     *
     * @return void
     */
    public function boot(Configuration $configuration)
    {
        $this->registerPolicies();

        Auth::extend(
            'jwt',
            fn ($app, $name, array $config) =>
            new JwtGuard(
                Auth::createUserProvider($config['provider']),
                $app['request'],
                $configuration
            )
        );
    }
}
