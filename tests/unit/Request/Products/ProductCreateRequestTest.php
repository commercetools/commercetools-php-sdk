<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Product\ProductDraft;
use Sphere\Core\Model\ProductType\ProductTypeReference;
use Sphere\Core\RequestTestCase;

class ProductCreateRequestTest extends RequestTestCase
{
    const PRODUCT_CREATE_REQUEST = '\Sphere\Core\Request\Products\ProductCreateRequest';

    public function getProduct()
    {
        return new ProductDraft(
            new ProductTypeReference('id'),
            new LocalizedString(['en' => 'productName']),
            new LocalizedString(['en' => 'product-name'])
        );
    }

    public function testMapResult()
    {
        $result = $this->mapResult(static::PRODUCT_CREATE_REQUEST, [$this->getProduct()]);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\Product', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::PRODUCT_CREATE_REQUEST, [$this->getProduct()]);
        $this->assertNull($result);
    }
}
