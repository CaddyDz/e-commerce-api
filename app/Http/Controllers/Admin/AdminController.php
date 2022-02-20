<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAdminRequest;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Admin\AdminLoginRequest;

class AdminController extends Controller
{
    /**
     * Create
     *
     * Insert a new admin user record to database
     *
     * @param \App\Http\Requests\CreateAdminRequest $request
     *
     * @return \Illuminate\Http\Response
     **/
    public function create(CreateAdminRequest $request)
    {
        User::create([
            'uuid' => Str::uuid()->toString(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $request->avatar,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'is_admin' => 1,
            'is_marketing' => $request->marketing,
        ]);

        return response([
            'status' => 'success',
        ]);
    }

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

    /**
     * Logout
     *
     * Blacklist the current token
     *
     * @return \Illuminate\Http\Response
     **/
    public function logout()
    {
        Auth::logout();

        return response([
            'message' => 'Logged out',
        ]);
    }
}
