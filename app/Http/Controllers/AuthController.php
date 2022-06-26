<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'error'=>true,
                'message' => 'E-mail ou senha inválidas.'
            ], 200);
        }
        $user = Auth::user();
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        return response()->json(['success' => $success,'message'=>"Login efectuado com sucesso.","user"=>$user], 200);
    }

    public function destroy(Request $request)
    {
        // Revoke a specific user token
        return $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'user logged out'
        ];
    }
}
