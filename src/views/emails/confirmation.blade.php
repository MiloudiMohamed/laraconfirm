@component('mail::message')
# You're on your way!
# Let's confirm your email address.

By clicking on the following link, you are confirming your email address.

@component('mail::button', ['url' => config('app.url') . '/' . $email . '/confirmation/' . $token ])
Confirm
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
