# Easy Email Confirmation for Your Laravel App

  This composer package offers an easy way to add confiirmation email step for your Laravel applications.

## Installation

Begin by pulling in the package through Composer.

```bash
composer require devmi/laraconfirm
```

Next, if using Laravel 5, include the service provider within your `config/app.php` file.

```php
'providers' => [
    Devmi\Laraconfirm\LaraconfirmServiceProvider::class,
];
```

run your migration
```bash
php artisan migrate
```

Then, replace those 3 traits and don't forget to import them under `Devmi\Laraconfirm\Traits\LaraconfirmLoginTrait`

in `App\Http\Controllers\Auth\LoginController;`
```php
use AuthenticatesUsers;
// By
use LaraconfirmLoginTrait;
```

in `App\Http\Controllers\Auth\RegisterController;`
```php
use RegistersUsers;
// By
use LaraconfirmRegisterTrait;
```

in `App\Http\Controllers\Auth\ResetPasswordController;`
```php
use ResetsPasswords;
// By
use LaraconfirmResetsPasswordsTrait;
```


Finally, to get a nice feedback message add this code to you login page

```php
// resources\views\auth\login.blade.php

@if (session('laraconfirmAlert'))
  <div class="alert alert-success">
    {{ session('laraconfirmAlert') }}
  </div>
@endif
// above the login form or anywhere you want
// the form is here below
...

```

That's it! You'll now be able to confirm your member email before they login.

