<?php

namespace App\Http\Controllers\Api\v1\Auth;

use auth;
use App\Models\ApiResponse;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->accessToken;
            $response = [
                'user' => auth()->user(),
                'token' => $token
            ];
            return ApiResponse::success($response);
        }
        $response = 'Email or password is incorrect';
        return ApiResponse::errors($response, 421);
    }

    public function logout(Request $request)
    {
        Token::where('user_id', auth()->user()->id)->update(
            [
                'revoked' => true
            ]
            );
        $response = 'You have been successfully logged out!';
        return ApiResponse::success($response);
    }

}