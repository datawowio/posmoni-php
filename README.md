Posmoni-php
=========================
Posmoni-php  HTTP RESTFul for calling Posmoni APIs
###### support or question support@datawow.io

# Requirements
* php 5.4 or above
* Built-in libcurl support.

# Installation
#### Composer
You can install library via [Compose](https://getcomposer.org/). Please check you have installed Composer on your machine and copy below code to your ```composer.json``` If you don't have composer then click on the link Official website to install
- [Installation Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

Copy below code to your composer.json

```json
"datawow/posmoni-php": "dev-master"
```

Run composer install
```
php composer.phar install
```
or (Global setup)
```
composer install
```

After you run composer install then you will have folder ```vendor/``` to store your libs. Now you can load those libs via
```php
require_once dirname(__FILE__).'/vendor/autoload.php';
```


# API explanation
There is model for calling our API and each of its there are 2 operations to use such as _create_ and _get_

#### moderation model.
- Moderation

### Model functions
For create data use `create()`
```php
/**
@param string $token
@param array $params
**/
Moderation::create($token, $params);
```

For query list of data use `get()`
```php
/**
@param string $token
@param array $params => array("query" => "")
**/
Moderation::get($token, $params);
```

Every function that being used must have `$token` which is a project token and  `$params` is a parameter that required for each model. For `$params` we're going to explanation in a usage section

https://dashboard.posmoni.com/app
