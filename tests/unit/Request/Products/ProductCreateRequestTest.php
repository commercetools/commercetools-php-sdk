<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;


use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\RequestTestCase;

class ProductCreateRequestTest extends RequestTestCase
{
    const PRODUCT_CREATE_REQUEST = '\Commercetools\Core\Request\Products\ProductCreateRequest';

    public function getProduct()
    {
        return ProductDraft::ofTypeNameAndSlug(
            ProductTypeReference::ofId('id'),
            LocalizedString::fromArray(['en' => 'productName']),
            LocalizedString::fromArray(['en' => 'product-name'])
        );
    }

    public function testMapResult()
    {
        $result = $this->mapResult(ProductCreateRequest::ofDraft($this->getProduct()));
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductCreateRequest::ofDraft($this->getProduct()));
        $this->assertNull($result);
    }
}
