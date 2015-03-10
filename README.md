# eloquent-replaceable


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
