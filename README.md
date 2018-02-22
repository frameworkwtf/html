# HTML

[![Build Status](https://travis-ci.org/frameworkwtf/html.svg?branch=master)](https://travis-ci.org/frameworkwtf/html) [![Coverage Status](https://coveralls.io/repos/frameworkwtf/html/badge.svg?branch=master&service=github)](https://coveralls.io/github/frameworkwtf/html?branch=master)


This package contains Twig template engine with flash messages and a useful Session class for WTF framework

## Installation

### Install via Composer

```php
composer require wtf/html
```

### Configure your app

Create config file `html.php`:

```php
<?php

declare(strict_types=1);

$cache_dir = __DIR__.'/../cache';

return [
    'template_path' => __DIR__.'/../views/',
    'cache_path' => __DIR__.'/../cache',
];
```

**Optional**: create `csrf.php` config:

```php
<?php

declare(strict_types=1);

return [
    'failure_callable' => function ($request, $response, $next) { //@link https://github.com/slimphp/Slim-Csrf#handling-validation-failure
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    }
];
```

### Add new provider and middleware

1. `\Wtf\Html\Provider` into your providers list (`suit.php` config)
2. `session_middleware` and `csrf_middleware` into your middlewares list (`suit.php` config)
3. Add `session_start()` in your public `index.php`

## Documentation

Plugin is currently extended with the following plugins. Instructions on how to use them in your own application are linked below.

| Plugin | README |
| ------ | ------ |
| Slim Twig | https://github.com/slimphp/Twig-View |
| Slim Flash | https://github.com/slimphp/Slim-Flash |
| Slim Twig Flash | https://github.com/kanellov/slim-twig-flash |
| Slim CSRF | https://github.com/slimphp/Slim-Csrf |
| RKA Session | https://github.com/akrabat/rka-slim-session-middleware |
