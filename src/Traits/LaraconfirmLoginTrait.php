<?php

namespace Devmi\Laraconfirm\Traits;

use Illuminate\Http\Request;
use Devmi\Laraconfirm\Models\EmailConfirmations;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

trait LaraconfirmLoginTrait
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        if (EmailConfirmations::whereEmail($user->email)->exists()) {
            auth()->logout();
            return back()->with('laraconfirmAlert', 'Please confirm your email address before you login.');
        }
    }
}
