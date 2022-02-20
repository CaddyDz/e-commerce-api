<?php

declare(strict_types=1);

use App\Models\Token;
use Illuminate\Support\Str;

if (!function_exists('generate_token_uuid')) {
    /**
     * Generate a unique ID for the token
     *
     * Recursive if UUID already exists
     *
     * @return string
     */
    function generate_token_uuid(): string
    {
        $uuid = Str::uuid()->toString();

        if (Token::where('unique_id', $uuid)->exists()) {
            return generate_token_uuid();
        }

        return $uuid;
    }
}
