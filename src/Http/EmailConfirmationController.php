<?php

namespace Devmi\Laraconfirm\Http;

use App\Http\Controllers\Controller;
use Devmi\Laraconfirm\Models\EmailConfirmations;

class EmailConfirmationController extends Controller
{

    public function activate($email, $token)
    {
        $operation = EmailConfirmations::where(['email' => $email], ['token' => $token]);

        if ($operation->exists()) {
            $operation->delete();
            return redirect()->route('login')->with('laraconfirmAlert', 'Your account has activated.');
        };
        abort(404);
    }
}
