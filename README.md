## DEPRECATION WARNING 

Webfaction will end it's services possibly from May 2021, so the package won't be maintained in the future.

# Laravel-Webfaction

Webfaction API wrapper for Laravel

## Requirements

Laravel 5.x

## Installation

Install with composer
```bash
composer require subdesign/laravel-webfaction:^1.0.0
```

> If you use Laravel 5.5+, you don't need to do the following two steps.

Add Service Provider to the `config/app.php`
```bash
Subdesign\LaravelWebfaction\WebfactionServiceProvider::class,
```

Add Facade to the `config/app.php`
```bash
'Webfaction' => Subdesign\LaravelWebfaction\Facades\Webfaction::class,
```

Publish the `webfaction.php` config file
```bash
php artisan vendor:publish --provider="Subdesign\LaravelWebfaction\WebfactionServiceProvider"
```

Set the credentials and other data in the `.env` file

```bash
WF_USERNAME=  
WF_PASSWORD=
WF_MACHINE=WebXXX
WF_DEBUG=false
WF_DEBUG_LEVEL=2
```

Where `WF_USERNAME` and `WF_PASSWORD` is your control panel username and password. 
If you have multiple machines, you can define the machine name `WF_MACHINE` like Web123 on which one you want to use the API.
`WF_DEBUG` will show debug information in the response, with `WF_DEBUG_LEVEL` you can set debug verbosity. Values: 0, 1 and 2.

## Dependency

The package has a dependency which is automatically installed: [https://github.com/gggeek/phpxmlrpc](https://github.com/gggeek/phpxmlrpc)

## Usage

You can find some examples here but all API methods described on [https://docs.webfaction.com/xmlrpc-api/apiref.html](https://docs.webfaction.com/xmlrpc-api/apiref.html).  
You have to use API calls the same way as you find in the API documentation. Eg. `list_disk_usage` in docs is the method `list_disk_usage()` in the API call.

List disk usage:
```php
Webfaction::list_disk_usage();
```

On create methods, you have to pass an array of values (except `session_id`) in the order of the method description! `session_id` is dynamically set in the background.

Creating an app:
```php
Webfaction::create_app([
    "app_name",  // name of your app
    "static_php72",  // app type
    false, // autostart app with autostart.cgi
    "", // extra_info field content
    false // open port
]);
```

If you don't like Facades, you can use the helper:
```php
webfaction()->list_mailboxes();
```

## Testing

Run
```bash
composer test
```

## Credits

- [Barna Szalai](https://github.com/subdesign)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
