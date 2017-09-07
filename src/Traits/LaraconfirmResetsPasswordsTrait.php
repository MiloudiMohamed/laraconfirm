<?php

namespace Devmi\Laraconfirm\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;

trait LaraconfirmResetsPasswordsTrait
{
    use ResetsPasswords;

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }

    protected function sendResetResponse($response)
    {
        return redirect()->route('login')->with('laraconfirmAlert', 'Your password has been reset!');
    }
}
