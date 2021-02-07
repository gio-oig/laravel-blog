<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => ['required','string','min:2','max:20'],
            'email' => ['required','email'],
            'password' => ['required','min:3','max:25','confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('login');
    }
    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return redirect()->route('login');
        }

        if(!Hash::check($request->password, $user->password)) {
            return redirect()->route('login');
        }

        Auth::loginUsingId($user->id);

        return redirect()->back();
    }
    public function resetPassword(Request $request) {
        dd($request->all());
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login');
    }
}
