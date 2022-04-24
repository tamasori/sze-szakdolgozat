<?php


namespace App\Http\Controllers\Auth;


use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\Auth\ResetPasswordNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController
{
    public function index()
    {
        return view("auth.reset-password");
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if($user){
            $password = Str::random(12);
            $user->update([
                "password" => Hash::make($password),
            ]);
            $user->notify(new ResetPasswordNotification($password));
        }
        return view("auth.reset-password")
            ->with("successes", [__("auth.password_sent")]);
    }
}
