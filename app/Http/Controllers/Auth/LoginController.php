<?php


namespace App\Http\Controllers\Auth;


use App\Http\Requests\Auth\LoginRequest;

class LoginController
{
    public function index()
    {
        return view("auth.login");
    }

    public function login(LoginRequest $request)
    {
        if (\Auth::attempt($request->only(["email", "password"]), true)) {
            return redirect()->route("dashboard");
        } else {
            return redirect()->route("auth.login")
                             ->withErrors([__("auth.failed")]);
        }
    }
}
