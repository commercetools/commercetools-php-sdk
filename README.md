# <img src="build/theme/resources/CT_cube_200px.png" width="40" align="center"></img> Composable Commerce PHP SDK

:warning: **This Composable Commerce PHP SDK is in its Active Support mode currently, and is planned to be deprecated, please note the following dates.

| Active Support        | Maintenance Support   | End of Life           |
| --------------------- | --------------------- | --------------------- |
| `28th February, 2022` | `31st August 2022.` | `1st September 2022.`   |

We recommend to use our [PHP SDK V2](https://docs.commercetools.com/sdk/php-sdk#php-sdk-v2).

[![Build Status](https://img.shields.io/travis/com/commercetools/commercetools-php-sdk/master.svg?style=flat-square)](https://travis-ci.com/commercetools/commercetools-php-sdk) [![Scrutinizer](https://img.shields.io/scrutinizer/g/commercetools/commercetools-php-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/commercetools/commercetools-php-sdk/) [![Scrutinizer](https://img.shields.io/scrutinizer/coverage/g/commercetools/commercetools-php-sdk.svg?style=flat-square)](https://scrutinizer-ci.com/g/commercetools/commercetools-php-sdk/) [![Packagist](https://img.shields.io/packagist/v/commercetools/php-sdk.svg?style=flat-square)](https://packagist.org/packages/commercetools/php-sdk) [![Packagist](https://img.shields.io/packagist/dm/commercetools/php-sdk.svg?style=flat-square)](https://packagist.org/packages/commercetools/php-sdk)

The PHP SDK allows developers to integrate with Composable Commerce APIs using PHP native interfaces, models and helpers instead of manually using the HTTP and JSON API.

You gain lots of IDE Auto-Completion, type checks on a literal API, Warnings, Object Mapping, i18n support etc.. The Client manages the OAuth2 security tokens, provides caches and interfaces for concurrent and asynchronous API calls.

The SDK is licensed under the permissive [MIT License](LICENSE). Don't hesitate to [contribute](#contribute)!


## Using the SDK

The [PHP API documentation](http://commercetools.github.io/commercetools-php-sdk) provides all the details you need in a searchable form (link points to latest stable release).

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

To get up and running, create a free test [Project](https://mc.commercetools.com/login/new) on Composable Commerce. You can create your first API Client in [The Merchant Center](https://mc.commercetools.com/) (Menu "Settings"->"Developer settings"->"Create new API client").
You need to select the template for the "Admin client".

```php
<?php

require '../vendor/autoload.php';

use Commercetools\Core\Builder\Request\RequestBuilder;
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
$search = RequestBuilder::of()->productProjections()->search()
    ->addParam('text.en', 'red');

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

If you prefer not to have a client with all admin rights, you need to explicitly include the client's permission scopes that you selected when creating the client, on the client's configuration:

```php
<?php
$config = [
    'client_id' => 'my client id',
    'client_secret' => 'my client secret',
    'project' => 'my project id',
    'scope' => 'permission_scope and_another_scope'
];
```

In projects you will not put your API credentials directly into code but use a config file or your framework's config or dependency injection system for that.

### Using the client factory

When using a Guzzle version of 6 or greater, it's also possible to use a preconfigured Guzzle client using the client factory. At the moment this is limited to client credentials authentication flow.

```php
<?php

require '../vendor/autoload.php';

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Client\ClientFactory;
use Commercetools\Core\Config;
use Commercetools\Core\Error\ApiException;
use Commercetools\Core\Model\Common\Context;

$config = [
    'client_id' => 'my client id',
    'client_secret' => 'my client secret',
    'project' => 'my project id'
];
$context = Context::of()->setLanguages(['en'])->setLocale('en_US')->setGraceful(true);
$config = Config::fromArray($config)->setContext($context)->setThrowExceptions(true);

/**
 * create a search request and a client,
 * execute the request and get the PHP Object
 * (the client can and should be re-used)
 */
$request = RequestBuilder::of()->productProjections()->search()
    ->addParam('text.en', 'red');

$client = ClientFactory::of()->createClient($config);

try {
    $response = $client->execute($request);
} catch (ApiException $exception) {
    throw new \Exception("Ooops! Something happened.", 0, $exception);
}
$products = $request->mapFromResponse($response);

header('Content-Type: text/html; charset=utf-8');

foreach ($products as $product) {
    echo $product->getName()->en . '<br/>';
}
```

#### Synchronous execution

```php
$request = ProductProjectionSearchRequest::of();
$response = $client->execute($request);
$products = $request->mapFromResponse($response);
```

#### Asynchronous execution
The asynchronous execution will return a promise to fulfill the request.

```php
$response = $client->executeAsync(ProductProjectionSearchRequest::of());
$products = $request->mapFromResponse($response->wait());
```

#### Batch execution
By filling the batch queue and starting the execution all requests will be executed in parallel.

```php
$responses = GuzzleHttp\Pool::batch(
    $client,
    [ProductProjectionSearchRequest::of()->httpRequest(), CartByIdGetRequest::ofId($cartId)->httpRequest()]
);
```

#### Using a logger

The client uses the PSR-3 logger interface for logging requests and deprecation notices. To enable
logging provide a PSR-3 compliant logger (e.g. Monolog).

```php
$logger = new \Monolog\Logger('name');
$logger->pushHandler(new StreamHandler('./requests.log'));
$client = ClientFactory::of()->createClient($config, $logger);
```

#### Using a cache adapter

The client will automatically request an OAuth token and store the token in the provided cache.

It's also possible to use a different cache adapter. The SDK provides a Doctrine, a Redis and an APCu cache adapter.
By default the SDK tries to instantiate the APCu or a PSR-6 filesystem cache adapter if there is no cache given.
E.g. Redis:

```php
$redis = new \Redis();
$redis->connect('localhost');
$client = ClientFactory::of()->createClient($config, $logger, $redis);
```

#### Using cache and logger

```php
$client = ClientFactory::of()->createClient($config, $logger, $cache);
```


#### Middlewares

Adding middlewares to the clients for Composable Commerce as well for the authentication can be done using the config
by setting client options.

For using a custom HandlerStack

```php
$handler = HandlerStack::create();
$handler->push(Middleware::mapRequest(function (RequestInterface $request) {
    ...
    return $request; })
);
$config = Config::of()->setClientOptions(['handler' => $handler])
```

For using an array of middlewares

```php
$middlewares = [
    Middleware::mapRequest(function (RequestInterface $request) {
    ...
    return $request; }),
    ...
]
$config = Config::of()->setClientOptions(['middlewares' => $middlewares])
```

#### Timeouts

The clients are configured to timeout by default after 60 seconds. This can be changed by setting the client options in the Config instance

```php
$config = Config::of()->setClientOptions([
    'defaults' => [
        'timeout' => 10
    ]
])
```

Another option is to specify the timeout per request

```php
$request = ProductProjectionSearchRequest::of();
$response = $client->execute($request, null, ['timeout' => 10]);
```

#### Retrying

As a request can error in multiple ways it's possible to add a retry middleware to the client config. E.g.: Retrying in case of service unavailable errors

```php
$config = Config::of()->setClientOptions([
    'defaults' => [
        'timeout' => 10
    ]
])
$maxRetries = 3;
$clientOptions = [
    'middlewares' => [
        'retry' => Middleware::retry(
            function ($retries, RequestInterface $request, ResponseInterface $response = null, $error = null) use ($maxRetries) {
                if ($response instanceof ResponseInterface && $response->getStatusCode() < 500) {
                    return false;
                }
                if ($retries > $maxRetries) {
                    return false;
                }
                if ($error instanceof ServiceUnavailableException) {
                    return true;
                }
                if ($error instanceof ServerException && $error->getCode() == 503) {
                    return true;
                }
                if ($response instanceof ResponseInterface && $response->getStatusCode() == 503) {
                    return true;
                }
                return false;
            },
            [RetryMiddleware::class, 'exponentialDelay']
        )
    ]
];
$config->setClientOptions($clientOptions);
```

### Using the phar distribution

Since version 1.6 the SDK is also released as a PHAR. You can find them in the [releases section](https://github.com/commercetools/commercetools-php-sdk/releases) at Github.

Usage example:
```php
<?php

require __DIR__ . '/commercetools-php-sdk.phar';

use Commercetools\Core\Client\ClientFactory;
use Commercetools\Core\Builder\Request\RequestBuilder;

$config = \Commercetools\Core\Config::fromArray([
    'client_id' => 'myClientId',
    'client_secret' => 'myClientSecret',
    'project' => 'myProjectId'
]);
$client = ClientFactory::of()->createClient($config);
$request = RequestBuilder::of()->project()->get();

$response = $client->execute($request);

$project = $request->mapFromResponse($response);
var_dump($project->toArray());
```

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

For running the integration tests you need an empty Project and have to create an API client using the commercetools Merchant Center with the scopes:
```
manage_project
view_orders
view_products
manage_my_shopping_lists
manage_my_orders
manage_my_payments
manage_my_profile
manage_api_clients
create_anonymous_token
```

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

docker run --env-file env.list -v $PWD:/opt/app -w /opt/app --rm=true jenschude/php-test-base tools/docker-phpunit.sh
```

### <a name="contribute"></a>Contribute

On bigger effort changes, please open a GitHub [issue](issues) and ask if you can help or get help with your idea. For typos and documentation improvements just make a pull request.

Then:

 1. fork the repository on GitHub
 2. code and add tests that cover the created code. Your code should be warning-free.
 3. stick to PSR-2 and and don't reformat existing code.
 4. make a pull request.  @jenschude will review it and pull or come back to you.




