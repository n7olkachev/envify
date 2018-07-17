# Envify [![Build Status](https://travis-ci.org/n7olkachev/envify.svg?branch=master)](https://travis-ci.org/n7olkachev/envify)

Envify your configs with ease

## Why?

I'm just tired of writing env('FOO_BAR_BAZ') so

## Examples

Default Laravel config/services.php looks like:

```php

return [
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
];
```

With this package it is just:

```php

return envify([
    'mailgun' => [
        'domain',
        'secret',
    ],
    'ses' => [
        'key',
        'secret',
        'region' => 'us-east-1',
    ],
    'sparkpost' => [
        'secret',
    ],
    'stripe' => [
        'model' => App\User::class,
        'key',
        'secret',
    ],
]);

```

And config/app.php example:

```php

return [
    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
];

```

Becomes 

```php
return envify('app', [
    'name' => 'Laravel',
    'env' => 'production',
    'debug' => false,
    'url' => 'http://localhost',
]);
```

`envify` function scan array keys and extracts appropriate values from env, so resulting
arrays will be the same.

Also, you can envify just a part of your config:

```php

return [
    ...
    'foo' => envify('bar', [
        'baz', // equals 'baz' => env('BAR_BAZ')
    ]),
];

```

## Installation

You can install the package via composer:

``` bash
composer require n7olkachev/envify
```

## Testing

``` bash
$ composer test
```

## Credits

- [Nikita Tolkachev](https://github.com/n7olkachev)

## Sponsored by

https://websecret.by/

Web agency based in Minsk, Belarus

## License

The MIT License (MIT)
