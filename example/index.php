<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 13:31
 */
namespace Sphere\Core;

use Sphere\Core\Model\Category\CategoryDraft;
use Sphere\Core\Model\Product\ProductVariantDraft;
use Sphere\Core\Model\Type\LocalizedString;
use Sphere\Core\Request\Products\ProductsSearchRequest;
use Sphere\Core\Response\PagedQueryResponse;

require '../vendor/autoload.php';

$appConfig = parse_ini_file('myapp.ini', true);

// create the sphere config object
$config = new Config();
$config->fromArray($appConfig['sphere']);

/**
 * create search request
 */
$search = new ProductsSearchRequest();

if (isset($_POST['search'])) {
    $search->addParam('text.en', $_POST['search']);
}

$client = new Client($config);

$products = $client->execute($search);
/**
 * @var PagedQueryResponse $products
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
    foreach ($products as $product) : ?>
        <h1><?= $product['name']['en'] ?></h1>
        <img src="<?= $product['masterVariant']['images'][0]['url'] ?>" width="100">
        <p><?= $product['description']['en'] ?></p>
    <?php
    endforeach;
    ?>
</body>
</html>
