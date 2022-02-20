<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            $this->unauthenticated($request);
        }

        return $next($request);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated(): void
    {
        throw new AuthenticationException('Unauthenticated.');
    }
}
