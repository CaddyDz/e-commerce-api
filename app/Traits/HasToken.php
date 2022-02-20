<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Token;
use Lcobucci\JWT\Configuration;

trait HasToken
{
    /**
     * Create a new personal access token for the user.
     *
     * @param string $name
     * @param array $abilities
     *
     * @return string $token
     */
    public function createToken(): string
    {
        $configuration = app()->get(Configuration::class);
        $unique_id = generate_token_uuid();

        $now = now()->toImmutable();
        $token = $configuration->builder()
            // set a random uuid, has to be unique and doesn't exist in the database, use it to check if the token is blacklisted
            // Token gets blacklisted on logout
            ->identifiedBy($unique_id)
            ->issuedBy(request()->getHost())
            ->permittedFor('admin', 'user')
            ->relatedTo((string) $this->id)
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now->subSecond())
            ->expiresAt($now->addDay())
            ->withClaim('user_uuid', $this->uuid)
            ->getToken($configuration->signer(), $configuration->signingKey());

        Token::create([
            'user_uuid' => $this->uuid,
            'unique_id' => $unique_id,
            // Probably the user agent
            'token_title' => substr(request()->userAgent(), 0, 255),
            'expires_at' => $now->addDay(),
        ]);

        return $token->toString();
    }
}
