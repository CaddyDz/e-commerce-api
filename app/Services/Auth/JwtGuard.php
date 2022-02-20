<?php

namespace App\Services\Auth;

use Exception;
use App\Models\Token;
use Illuminate\Http\Request;
use Lcobucci\JWT\Configuration;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class JwtGuard implements Guard
{
    use GuardHelpers;

    /** @var \Illuminate\Http\Request $request The request instance */
    protected Request $request;

    /** @var \Lcobucci\JWT\Configuration $configuration The JWT configuration object */
    protected $configuration;

    /** @var array $constraints Validation constraints */
    protected array $constraints;

    /**
     * Create a new authentication guard.
     *
     * @param \Illuminate\Contracts\Auth\UserProvider $provider
     * @param \Illuminate\Http\Request $request
     * @param \Lcobucci\JWT\Configuration $configuration
     * @return void
     */
    public function __construct(
        UserProvider $provider,
        Request $request,
        Configuration $configuration
    ) {
        $this->provider = $provider;
        $this->request = $request;
        $this->configuration = $configuration;
        $this->constraints = $configuration->validationConstraints();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        try {
            $bearer = $this->request->bearerToken();

            if (!$this->validate(['token' => $bearer])) {
                return;
            }

            $token = $this->configuration->parser()->parse($bearer);

            // Validate token
            $this->configuration->validator()->assert($token, ...$this->constraints);

            $this->user = $this->provider->retrieveById($token->claims()->get('user_uuid'));
        } catch (Exception $exception) {
            return;
        }
    }

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        if (empty($credentials['token'])) {
            return false;
        }

        $token = $this->configuration->parser()->parse($credentials['token']);

        // Check token is not restricted (blacklisted)
        if (
            Token::where('unique_id', $token->claims()->get('jti'))
                ->where('restrictions', 1)
                ->exists()
        ) {
            return false;
        }


        // Stop at the very first violation as oppose to assert
        return $this->configuration->validator()->validate($token, ...$this->constraints);
    }
}
