<?php

namespace Urbelog\Api\V1\Controllers;

use Config;
use Urbelog\User;
use Tymon\JWTAuth\JWTAuth;
use Urbelog\Http\Controllers\Controller;
use Urbelog\Api\V1\Requests\LoginRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SignUpController extends Controller
{
    public function signUp(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if(!$user->save()) {
            throw new HttpException(500);
        }

        if(!Config::get('boilerplate.sign_up.release_token')) {
            return response()->json([
                'status' => 'ok'
            ], 201);
        }

        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'status' => 'ok',
            'token' => $token
        ], 201);
    }
}
