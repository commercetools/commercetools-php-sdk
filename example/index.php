<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 13:31
 */
namespace Sphere\Core;

use Sphere\Core\Request\Products\ProductsSearchRequest;

require '../vendor/autoload.php';

$appConfig = parse_ini_file('myapp.ini', true);

// create the sphere config object
$config = new Config();
$config->fromArray($appConfig['sphere']);

/**
 * create search request
 */
$search = new ProductsSearchRequest();
$search->addParam('text.en', 'red');

$client = new Client($config);
$results = $client->execute($search);

foreach ($results as $result) {
    var_dump($result);
}
