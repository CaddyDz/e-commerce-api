<?php

namespace App\Console\Commands;

use Spatie\Crypto\Rsa\KeyPair;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateJWTKeyPair extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jwt:generate
        {--f|force : Skip confirmation when overwriting existing key pair.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a private/public RSA key pair for JWT';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (
            Storage::exists('public_key.pem') &&
            Storage::exists('private_key.pem') &&
            !$this->option('force') &&
            !$this->confirm('Key pair already exists, overriding will invalidate all existing tokens, Do you wish to continue?')
        ) {
            $this->error('Cancelled, keys already exist');
            return 1;
        }

        /**
         * digest algorithm: OPENSSL_ALGO_SHA512
         * private key bits: 4096
         * private key type: OPENSSL_KEYTYPE_RSA
         */
        (new KeyPair())->generate(
            storage_path('app/private_key.pem'),
            storage_path('app/public_key.pem')
        );

        $this->info('Keys Generated');

        return 0;
    }
}
