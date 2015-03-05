<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 13:31
 */
namespace Sphere\Core;

use Monolog\Handler\StreamHandler;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Product\ProductProjection;
use Sphere\Core\Model\Product\ProductProjectionCollection;
use Sphere\Core\Request\Products\ProductsSearchRequest;

require '../vendor/autoload.php';

$appConfig = parse_ini_file('myapp.ini', true);

$context = new Context();
$context->setLanguages(['en'])->setGraceful(true);

// create the sphere config object
$config = new Config();
$config->fromArray($appConfig['sphere'])->setContext($context);

/**
 * create search request
 */
$search = null;
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}
$request = new ProductsSearchRequest($config->getContext());
$request->addParam('text.' . current($config->getContext()->getLanguages()), $search);

/**
 * instantiate client and execute search request
 */
$log = new \Monolog\Logger('name');
$log->pushHandler(new StreamHandler('./requests.log'));

$client = new Client($config, null, $log);

$products = $client->execute($request)->toObject();

/**
 * @var ProductProjectionCollection $products
 */
?>
<html>
<head>
    <title>Sphere PHP SDK example</title>
</head>
<body>
    <form method="POST" action=".">
        <label for="search">Search</label>
        <input type="text" name="search">
        <input type="submit">
    </form>
    <?php
    $startTime = microtime(true);
    /**
     * @var ProductProjection $product
    */
    foreach ($products as $product) : ?>
        <h1><?= $product->getName() ?></h1>
        <img src="<?= $product->getMasterVariant()->getImages()->getAt(0)->getSmall() ?>" width="100">
        <p><?= $product->getDescription() ?></p>
        <?php
    endforeach;
    $endtime1 = (microtime(true) - $startTime) * 1000;
    ?>
</body>
</html>
