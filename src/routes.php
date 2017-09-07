<?php

Route::get(
        '/{email}/confirmation/{token}',
        'Devmi\Laraconfirm\Http\EmailConfirmationController@activate'
    )->middleware('web');
