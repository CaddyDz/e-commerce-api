<?php

declare(strict_types=1);

namespace App\Providers;

use Lcobucci\JWT\Configuration;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Illuminate\Support\ServiceProvider;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\PermittedFor;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;

class JwtServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Configuration::class, function ($app): Configuration {
            $signer = new Sha256();
            $key = InMemory::file(storage_path('app/public_key.pem'));
            $config = Configuration::forAsymmetricSigner(
                signer: $signer,
                // TODO: check if keys exist, throw custom exception if not
                // Maybe offer an ignition solution suggesting to run jwt:generate
                signingKey: InMemory::file(storage_path('app/private_key.pem')),
                verificationKey: $key
            );
            $config->setValidationConstraints(
                new IssuedBy(parse_url(config('app.url'))['host']),
                new PermittedFor('admin', 'user'),
                new SignedWith($signer, $key),
                new StrictValidAt(clock: SystemClock::fromSystemTimezone())
            );
            return $config;
        });
    }
}
