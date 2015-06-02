# eloquent-replaceable

> Note: The `master` branch and releases `>=1.0` are for Laravel 5. Use the `0.x` branch or `~0.9` releases for Laravel 4.


## Installation

Include the package:

```sh
composer require "cviebrock/eloquent-replaceable:~0.9"
```

Add the service provider to `app/config.php`:

```php
'providers' => [
    'Cviebrock\EloquentReplaceable\ServiceProvider',
],
```

Publish the configuration:

```sh
php artisan config:publish "cviebrock/eloquent-replaceable"
```


## Configuration

Update `app/config/packages/cviebrock/eloquent-replaceable/config.php` as needed (see the comment in the file for help).


## Usage

```php
$model = Model::find(1);

// echo the raw model attribute:
echo $model->some_attribute;

// echo the model attribute with all replacements handled:
echo $model->doReplacements('some_attribute');
```
