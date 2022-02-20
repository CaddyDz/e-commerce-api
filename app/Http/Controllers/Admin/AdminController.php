<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Admin\AdminLoginRequest;

class AdminController extends Controller
{
    /**
     * Login
     *
     * Admin API endpoint
     *
     * @param \App\Http\Requests\Admin\AdminLoginRequest $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\AuthenticationException
     **/
    public function login(AdminLoginRequest $request)
    {
        $user = User::admin()->whereEmail($request->email)
            ->select('id', 'uuid', 'password')
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response([
                'success' => 1,
                'data' => [
                    'token' => $user->createToken(),
                ],
                'error' => null,
                'errors' => [],
                'extra' => [],
            ]);
        }

        throw new AuthenticationException(trans('auth.failed'));

        return response([
            'success' => 0,
            'data' => [],
            'error' => 'Failed to authenticate user',
            'errors' => [],
            'trace' => [],
        ]);
    }
}
