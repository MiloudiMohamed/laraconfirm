<?php

namespace Devmi\Laraconfirm\Http;

use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Devmi\Laraconfirm\Models\EmailConfirmations;
use Devmi\Laraconfirm\Mail\AccountActivationEmail;

class EmailConfirmationController extends Controller
{

    public function activate($email, $token)
    {
        $operation = EmailConfirmations::where(['email' => $email], ['token' => $token]);

        if ($operation->exists()) {
            $operation->delete();
            return redirect()->route('login')->with('laraconfirmAlert', 'Your account has been activated.');
        };
        abort(404);
    }

    public function showResendForm()
    {
        return view('Laraconfirm::emails.resend');
    }

    public function resend(Request $request)
    {
        $this->validateResendRequest($request);

        if ($this->tooManyResendRequestChecker($request)) {
            return back()->withDanger('Too many requests, try again after 5 minutes.');
        }

        $email = $request->email;
        $token = str_random(191);
        EmailConfirmations::whereEmail($email)->update(['token' => $token]);
        Mail::to($email)->send(new AccountActivationEmail($email, $token));

        return back()->withSuccess('Account confirmation email has been resent.');
    }

    protected function tooManyResendRequestChecker($request)
    {
        $account = EmailConfirmations::whereEmail($request->email)->first();

        return $account->updated_at->addMinute('5') > Carbon::now();
    }

    protected function validateResendRequest ($request) {
        $this->validate($request, [
            'email' => 'required|email|exists:email_confirmations,email'
        ], [
            'email.exists' => 'Could not find that account.'
        ]);
    }
}
