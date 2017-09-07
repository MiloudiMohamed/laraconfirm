<?php

namespace Devmi\Laraconfirm\Traits;

use Mail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Devmi\Laraconfirm\Models\EmailConfirmations;
use Devmi\Laraconfirm\Mail\AccountActivationEmail;

trait LaraconfirmRegisterTrait
{
    use RegistersUsers;

    protected function registered(Request $request, $user)
    {
        if (!EmailConfirmations::whereEmail($user->email)->exists()) {
            auth()->logout();
            $this->handle($user->email);
        }

        return redirect('/login')->with('laraconfirmAlert', 'We\'ve sent you a confirmation email at: ' . $user->email);
    }

    public function handle($email)
    {
        $token = str_random(191);

        EmailConfirmations::create([
            'email' => $email,
            'token' => $token,
        ]);

        Mail::to($email)->send(new AccountActivationEmail($email ,$token));
    }

}
