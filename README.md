![SPHERE.IO icon](https://admin.sphere.io/assets/images/sphere_logo_rgb_long.png)
# SPHERE.IO PHP SDK

> STATUS: technically robust beta version, but we do not yet guarantee API compatibility until the 1.0.0 release.  Please take your time to thoroughly test the upcoming RC (Milestone 4) release. 
> See the [Milestone Plan](https://github.com/sphereio/sphere-php-sdk/milestones?direction=desc&sort=completeness&state=open) for details of what's planned in detail. We love feedback and [Issue reports](https://github.com/sphereio/sphere-php-sdk/issues?q=is%3Aopen+is%3Aissue+sort%3Acreated-asc)!

[![Build Status](https://img.shields.io/travis/sphereio/sphere-php-sdk/master.svg?style=flat-square)](https://travis-ci.org/sphereio/sphere-php-sdk) [![Scrutinizer](https://img.shields.io/scrutinizer/g/sphereio/sphere-php-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/sphereio/sphere-php-sdk/) [![Scrutinizer](https://img.shields.io/scrutinizer/coverage/g/sphereio/sphere-php-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/sphereio/sphere-php-sdk/) [![Packagist](https://img.shields.io/packagist/v/sphere/php-sdk.svg?style=flat-square)](https://packagist.org/packages/sphere/php-sdk) [![Packagist](https://img.shields.io/packagist/dm/sphere/php-sdk.svg?style=flat-square)](https://packagist.org/packages/sphere/php-sdk)

The PHP SDK allows developers to build applications on the SPHERE.IO REST API using PHP native interfaces, models and helpers instead of manually using the HTTP and JSON API. You gain lots of IDE Auto-Completion, type checks on a literal API, Warnings, Object Mapping, i18n support etc..
It also manages the OAuth2 security, provides caches and an interface for concurrent and asynchronous API calls.

The SDK is licensed under the permissive [MIT License](LICENSE). Don't hesitate to [contribute](#contribute)!

## Install & Integrate the SDK into your Project

The SDK requires a PHP version of 5.4 or higher with the apc(u) PHP extension for its default cache. If you provide an own Cache interface, apc(u) is not necessary. 
The curl extension is recommended but not strictly necessary because the SDK is using the [Guzzle library](https://github.com/guzzle/guzzle) library, which falls back to PHP stream wrappers if curl is not available.
The intl extension is required to directly output Money objects as a String. 

The recommended way to install the SDK is through [Composer](http://getcomposer.org).

```bash
# Install Composer if not installed yet
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest version of the SDK:

```bash
composer require sphere/php-sdk dev-master
```

After installing, you need to require Composer's autoloader if that's not yet the case:

```php
require 'vendor/autoload.php';
```

If you don't use Composer, just [download a zip archive](https://github.com/sphereio/sphere-php-sdk/archive/master.zip) of the latest release, manually integrate it and configure your own autoloader.

Until the 1.0.0 release M0, M1 etc. milestone releases can contain incompatible changes.  From 1.0.0 on, the project will follow the [semantic versioning](http://semver.org) guidelines, i.e. everything but major version changes are backwards-compatible. This matches composer's default behavior.

With composer just run `composer update sphere/php-sdk` to update to compatible versions. Edit your `composer.json` file to update to incompatible versions.

Please read the [Changelog](CHANGELOG.md) before updating in any case.

## Use the SDK

The [PHP API documentation](http://sphereio.github.io/sphere-php-sdk/docs/master) provides all the details you need in a searchable form.

To get up and running, [create a free test project](http://admin.sphere.io) to get a SPHERE project with API credentials (Menu "Developers"->"API Clients").

```php
<?php

require '../vendor/autoload.php';

use Sphere\Core\Request\Products\ProductsSearchRequest;
use Sphere\Core\Client;

$config = [
    'client_id' => 'my client id',
    'client_secret' => 'my client secret',
    'project' => 'my project id'
];

/**
 * create a search request and a client,
 * execute the request and get the PHP Object
 * (the client can and should be re-used)
 */
$search = ProductsSearchRequest::of()->addParam('text.en', 'red');

$client = new Client($config);
$products = $client->execute($search)->toObject();

/**
 * show result (would be a view layer in real world)
 */
header('Content-Type: text/html; charset=utf-8');

foreach ($products as $product) {
    echo $product->getName()->en . '<br/>';
}

?>
```

In real world, you will not put your API credentials directly into code but use a config file or your framework's config or dependency injection system for that.

## Improve & Contribute to the SDK project

prepare your development environment (if necessary).

Mac OS X, assuming [Homebrew](http://brew.sh) is installed, do the following:

```sh
xcode-select --install
brew tap homebrew/dupes
brew tap homebrew/versions
brew tap homebrew/homebrew-php
brew install php55
brew install php55-intl
brew install php55-apcu
brew install php55-xdebug
brew install ant
# you probably also need to fix a (=any) timezone in your php.ini:
echo "date.timezone='Europe/Berlin'" >> /usr/local/etc/php/5.5/conf.d/60-user.ini
# initialize the dependencies:
php composer.phar update
```

Linux users install php 5.4+, apc(u), xdebug and ant according to their distro's package system.

Clone the develop branch of the repository (we're using the [gitflow](http://nvie.com/posts/a-successful-git-branching-model/) branching model, so master is for releases only):

```
git clone git@github.com:sphereio/sphere-php-sdk.git
```

Please follow the [PSR-2](http://www.php-fig.org/psr/psr-2/) coding style, ideally via your IDE settings (see below for phpStorm instructions).

Please make sure that exiting Unit and Integration tests don't fail and fully cover your new code with Unit Tests. You can run all tests locally:

```
ant
```

### Built In Test Server

You can use the `docroot` directory with the built-in PHP web server. Add to the docroot directory a file called "myapp.ini". Add following content and setup with your API credentials:

```ini
[sphere]
client_id = 'my client id'
client_secret = 'my client secret'
project = 'my project id'
```

Then activate the php builtin web server

```sh
cd <project_folder>
php -S localhost:8000 -t docroot
```

Now navigate to [http://localhost:8000](http://localhost:8000) in your browser.

### phpStorm

To enable code style checks directly in phpStorm you have to configure the path to the phpcs at Preferences > Languages & Frameworks > PHP > Code Sniffer.
Now you can enable at Preferences > Editor > Inspections > PHP the "PHP code sniffer validation" with PSR-2 standard. Change the severity if needed.


### <a name="contribute"></a>Contribute

On bigger effort changes, please open a GitHub [issue](issues) and ask if you can help or get help with your idea. For typos and documentation improvements just make a pull request.

Then:

 1. fork the repository on GitHub
 2. code and add tests that cover the created code. Your code should be warning-free.
 3. stick to PSR-2 and and don't reformat existing code.
 4. make a pull request.  @ct-jensschulze will review it and pull or come back to you.




