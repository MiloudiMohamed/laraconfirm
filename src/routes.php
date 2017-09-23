<?php

Route::group(['middleware' => 'web'], function () {
    Route::get(
        '/email/confirmation/resend', 'Devmi\Laraconfirm\Http\EmailConfirmationController@showResendForm')
    ->name('email.confirmation.resend');
Route::post('/email/confirmation/resend', 'Devmi\Laraconfirm\Http\EmailConfirmationController@resend');

    Route::get('/{email}/confirmation/{token}','Devmi\Laraconfirm\Http\EmailConfirmationController@activate');

});


