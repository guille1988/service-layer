# Installation and usage instructions:

## What it does:

This package allows you to create the service layer of a Laravel project, or all the layers necessary for the development of an application; in a fast and personalized way. You can put the name you want to this layer, Service, Repository or anything you want; it's your choice. Look at the configuration section, to personalize this package and adapt it your preferences =).

## Installation:

```php
composer require felipetti/service-layer
```

## Usage instructions:

To build a service layer, example:

```php
php artisan make:service UserService
```

To build all layers, example:

```php
php artisan make:all Post
```

You can modify the creation of layers and other stuff, publishing config:

```php
php artisan vendor:publish --tag=service-layer-config
```

To publish stub and personalize the service file:

```php
php artisan vendor:publish --tag=service-layer-stub
```
## Configuration:

You can put the destination path of your service file here:

```php
'service_folder_path' => app_path('Services')
```

You can put the destination path of your stub file here:

```php
'stub_folder_path' => base_path('stub')
```

You can put the parameters passed by to [make:all] command here:

```php
'parameters' => '-mfsc'
```
## Comments:

Despite not containing a very difficult logic, this package was thought to help optimize the creation of the service layer and the others too, so used every day by developers who love using Laravel. If you like this package, please don't hesitate to star me, it will really help a lot =).

## Security:

If you discover any security-related issues, please email [guill388@hotmail.com](mailto:guill388@hotmail.com) instead of using the issue tracker.

## Issues:

For any issues, questions or suggestions, please don't hesitate to post it in issues or send a mail to the one above.

## Credits:

Special thanks to [Franciso Panozzo](https://github.com/franpanozzo) who greatly helped me along the way =).

## License:

The MIT License (MIT).
