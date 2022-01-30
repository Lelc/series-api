<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;

/**
 * TokenController
 */
class TokenController extends Controller
{
    /**
     * Create Token
     *
     * @param Request $request
     *
     * @return Array
     */
    public function createToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where(['email' => $request->email])->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json('Wrong user or password', 401);
        };

        $token = JWT::encode(['email' => $request->email], env('JWT_KEY'), 'HS256');

        return ['access_token' => $token];
    }
}
