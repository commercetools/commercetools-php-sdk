# <img src="build/theme/resources/CT_cube_200px.png" width="40" align="center"></img> commercetools PHP SDK

[![Build Status](https://img.shields.io/travis/commercetools/commercetools-php-sdk/master.svg?style=flat-square)](https://travis-ci.org/commercetools/commercetools-php-sdk) [![Scrutinizer](https://img.shields.io/scrutinizer/g/commercetools/commercetools-php-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/commercetools/commercetools-php-sdk/) [![Scrutinizer](https://img.shields.io/scrutinizer/coverage/g/commercetools/commercetools-php-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/commercetools/commercetools-php-sdk/) [![Packagist](https://img.shields.io/packagist/v/commercetools/php-sdk.svg?style=flat-square)](https://packagist.org/packages/commercetools/php-sdk) [![Packagist](https://img.shields.io/packagist/dm/commercetools/php-sdk.svg?style=flat-square)](https://packagist.org/packages/commercetools/php-sdk)

The PHP SDK allows developers to build applications on the commercetools platform (technically speaking against our REST API) using PHP native interfaces, models and helpers instead of manually using the HTTP and JSON API.

You gain lots of IDE Auto-Completion, type checks on a literal API, Warnings, Object Mapping, i18n support etc.. The Client manages the OAuth2 security tokens, provides caches and interfaces for concurrent and asynchronous API calls.

The SDK is licensed under the permissive [MIT License](LICENSE). Don't hesitate to [contribute](#contribute)!


## Using the SDK

The [PHP API documentation](http://commercetools.github.io/commercetools-php-sdk/docs/master) provides all the details you need in a searchable form (link points to latest stable release).

### Install & Integrate the SDK into your Project

The SDK requires a PHP version of 5.6 or higher. The SDK tries to use the APC(u) as it's default cache. If you provide a [PSR-6](https://packagist.org/providers/psr/cache-implementation) or [PSR-16](https://packagist.org/providers/psr/simple-cache-implementation) compliant cache adapter, APC(u) is not necessary. The [cache/filesystem-adapter](https://packagist.org/packages/cache/filesystem-adapter) is tried to be used if no APC(u) is installed.

The curl extension is recommended but not strictly necessary because the SDK is using the [Guzzle library](https://github.com/guzzle/guzzle) library, which falls back to PHP stream wrappers if curl is not available.
The intl extension is required to directly output Money objects as a String.

The recommended way to install the SDK is through [Composer](http://getcomposer.org).

```bash
# Install Composer if not installed yet
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest version of the SDK:

```bash
composer require commercetools/php-sdk
```

The SDK supports Guzzle6 as well as Guzzle5 as HTTP client. For Guzzle6:

```bash
composer require guzzlehttp/guzzle ^6.0
```

When you want to use Guzzle5 you have to ensure react/promise at minimum version 2.2:

```bash
composer require guzzlehttp/guzzle ^5.3.1
composer require react/promise ^2.2
```

After installing, you need to require Composer's autoloader if that's not yet the case:

```php
require 'vendor/autoload.php';
```

If you don't use Composer, just [download a zip archive](https://github.com/commercetools/commercetools-php-sdk/archive/master.zip) of the latest release, manually integrate it and configure your own autoloader.

The project follows the [semantic versioning](http://semver.org) guidelines, i.e. everything but major version changes are backwards-compatible. This matches composer's default behavior.

With composer just run `composer update commercetools/php-sdk` to update to compatible versions. Edit your `composer.json` file to update to incompatible versions.

Please read the [Changelog](CHANGELOG.md) before updating in any case.

### Getting started

To get up and running, [create a free test project](http://admin.sphere.io) on the commercetools platform with API credentials (Menu "Developers"->"API Clients").

```php
<?php

require '../vendor/autoload.php';

use Commercetools\Core\Request\Products\ProductProjectionSearchRequest;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Model\Common\Context;

$config = [
    'client_id' => 'my client id',
    'client_secret' => 'my client secret',
    'project' => 'my project id'
];
$context = Context::of()->setLanguages(['en'])->setLocale('en_US')->setGraceful(true);
$config = Config::fromArray($config)->setContext($context);

/**
 * create a search request and a client,
 * execute the request and get the PHP Object
 * (the client can and should be re-used)
 */
$search = ProductProjectionSearchRequest::of()->addParam('text.en', 'red');

$client = Client::ofConfig($config);
$products = $client->execute($search)->toObject();

/**
 * show result (would be a view layer in real world)
 */
header('Content-Type: text/html; charset=utf-8');

foreach ($products as $product) {
    echo $product->getName()->en . '<br/>';
}

```

In real world, you will not put your API credentials directly into code but use a config file or your framework's config or dependency injection system for that.

## Improve & Contribute to the SDK project

### Mac OS X preparations:
assuming [Homebrew](http://brew.sh) is installed, do the following:

```sh
xcode-select --install
brew tap homebrew/dupes
brew tap homebrew/versions
brew tap homebrew/homebrew-php
brew install php56
brew install php56-intl
brew install php56-xdebug
brew install ant
# you probably also need to fix a (=any) timezone in your php.ini:
echo "date.timezone='Europe/Berlin'" >> /usr/local/etc/php/5.6/conf.d/60-user.ini
# initialize the dependencies:
php composer.phar update
```

### Linux preparations :
 * install php 5.6+, xdebug and ant according to their distro's package system.
 * make sure the curl, intl, mbstring and openssl extensions are activated in php.ini

### Windows preparations:
 * [install php](http://windows.php.net/download/) 5.6+, i.e. extract ZIP and make add php.exe location to your PATH. Use WAMP etc. if you like, but plain PHP commandline is all you really need (you can test example code in the built-in webserver).
 * enable the curl, intl, mbstring and openssl extenstions in php.ini
 * make a working ant available in the PATH
 * and [install composer](https://getcomposer.org/doc/00-intro.md#installation-windows).

### Start working:

Clone the develop branch of the repository (we're using the [gitflow](http://nvie.com/posts/a-successful-git-branching-model/) branching model, so master is for releases only):

```
git clone git@github.com:commercetools/commercetools-php-sdk.git
```

Please follow the [PSR-2](http://www.php-fig.org/psr/psr-2/) coding style, ideally via your IDE settings (see below for PhpStorm instructions).

Please make sure that exiting Unit and Integration tests don't fail and fully cover your new code with Unit Tests. You can run all tests locally:

```
ant
```

### Built In Test Server

You can use the `docroot` directory with the built-in PHP web server. Add to the docroot directory a file called "myapp.yml". Add following content and setup with your API credentials:

```yaml
parameters:
    client_id: my client id
    client_secret: my client secret
    project: my project id
```

Then activate the php builtin web server

```sh
cd <project_folder>
php -S localhost:8000 -t docroot
```

Now navigate to [http://localhost:8000](http://localhost:8000) in your browser.

### PhpStorm configuration

To enable code style checks directly in PhpStorm you have to configure the path to the phpcs at Preferences > Languages & Frameworks > PHP > Code Sniffer.
Now you can enable at Preferences > Editor > Inspections > PHP the "PHP code sniffer validation" with PSR-2 standard. Change the severity if needed.


### Running integration tests

For running the integration tests you need an empty commercetools project and have to create an API client using the commercetools Admin Center with the scopes manage_project, view_orders and view_products.

#### Local environment

```sh
composer update
vendor/bin/phpunit
```

#### Using docker

Running the test image:

```sh
echo "COMMERCETOOLS_CLIENT_ID=YourClientID" > env.list
echo "COMMERCETOOLS_CLIENT_SECRET=YourClientSecret" >> env.list
echo "COMMERCETOOLS_PROJECT=YourProjectKey" >> env.list

docker run --env-file env.list -v $PWD:/opt/app -w /opt/app --rm=true jaysde/php-test-base tools/docker-phpunit.sh
```

### <a name="contribute"></a>Contribute

On bigger effort changes, please open a GitHub [issue](issues) and ask if you can help or get help with your idea. For typos and documentation improvements just make a pull request.

Then:

 1. fork the repository on GitHub
 2. code and add tests that cover the created code. Your code should be warning-free.
 3. stick to PSR-2 and and don't reformat existing code.
 4. make a pull request.  @jayS-de will review it and pull or come back to you.




