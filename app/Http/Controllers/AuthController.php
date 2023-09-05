<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login (Request $request) {
        $loginData = $request->only(['username', 'password']);
        $user = User::where('username', $loginData['username'])
            ->where('password', $loginData['password'])
            ->first();

        if ($user) {
            Auth::login($user);
            return redirect('/');
        } else {
            return redirect('/login')->withErrors([
                'msg' => 'Login failed'
            ]);
        }
    }

    public function logout () {
        Auth::logout();
        return redirect(route('home'));
    }

    public function apiLogin(Request $request) {
        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $author = Author::where('login', $validated['login'])->first();

        if (!$author) {
            return response()->json([
                'message' => 'Login or password is incorrect'
            ], 401);
        }

        $author->makeVisible('password'); /* Добавляем в модель пароль, для проверки */

        if (!Hash::check($validated['password'], $author->password)) {
            return response()->json([
                'message' => 'Login or password is incorrect'
            ], 401);
        }

        /* Отзываем все предыдущие токены пользователя */
        foreach ($author->tokens as $token) {
            $token->delete();
        }

        return response()->json([
            'token' => $author->createToken('apiToken')->plainTextToken
        ]);
    }
}
