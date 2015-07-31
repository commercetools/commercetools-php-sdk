<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 13:31
 */
namespace Commercetools\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Product\ProductProjection;
use Commercetools\Core\Model\Product\ProductProjectionCollection;
use Commercetools\Core\Request\Products\ProductProjectionSearchRequest;

require '../vendor/autoload.php';

$appConfig = parse_ini_file('myapp.ini', true);

$context = Context::of()->setLanguages(['en'])->setGraceful(true);

// create the api client config object
$config = Config::fromArray($appConfig['commercetools'])->setContext($context);

/**
 * create search request
 */
$search = null;
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
$request = ProductProjectionSearchRequest::of($config->getContext())
    ->addParam('text.' . current($config->getContext()->getLanguages()), $search);

$log = new Logger('name');
$log->pushHandler(new StreamHandler('./requests.log'));

$client = Client::ofConfigAndLogger($config, $log);

$products = $client->execute($request)->toObject();

/**
 * @var ProductProjectionCollection $products
 */
?>
<html>
<head>
    <title>Commercetools PHP SDK example</title>
</head>
<body>
    <form method="POST" action=".">
        <label for="search">Search</label>
        <input type="text" name="search">
        <input type="submit">
    </form>
    <?php
    /**
     * @var ProductProjection $product
    */
    foreach ($products as $product) : ?>
        <h1><?= $product->getName() ?></h1>
        <img src="<?= $product->getMasterVariant()->getImages()->getAt(0)->getSmall() ?>" width="100">
        <p><?= $product->getDescription() ?></p>
        <?php
    endforeach;
    ?>
</body>
</html>
