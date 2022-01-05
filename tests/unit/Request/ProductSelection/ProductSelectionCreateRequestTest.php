<?php

namespace Commercetools\Core\Request\ProductSelection;

use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\ProductSelection\ProductSelection;
use Commercetools\Core\Model\ProductSelection\ProductSelectionDraft;
use Commercetools\Core\Request\ProductSelections\ProductSelectionCreateRequest;
use Commercetools\Core\RequestTestCase;

class ProductSelectionCreateRequestTest extends RequestTestCase
{
    const PRODUCT_SELECTION_CREATE_REQUEST = ProductSelectionCreateRequest::class;

    public function getProductSelection()
    {
        return ProductSelectionDraft::ofName(
            LocalizedString::fromArray(['en' => 'productSelectionName'])
        );
    }

    public function testMapResult()
    {
        $result = $this->mapResult(ProductSelectionCreateRequest::ofDraft($this->getProductSelection()));
        $this->assertInstanceOf(ProductSelection::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(ProductSelectionCreateRequest::ofDraft($this->getProductSelection()));
        $this->assertNull($result);
    }
}
