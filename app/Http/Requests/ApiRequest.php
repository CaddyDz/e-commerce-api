<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Http\Request;

class ApiRequest extends Request
{
    public function expectsJson(): bool
    {
        return true;
    }

    public function wantsJson(): bool
    {
        return true;
    }
}
