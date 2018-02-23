<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories;

use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\RequestTestCase;

class TaxCategoryCreateRequestTest extends RequestTestCase
{
    const TAX_CATEGORY_CREATE_REQUEST = TaxCategoryCreateRequest::class;

    protected function getTaxCategory()
    {
        return TaxCategoryDraft::fromArray([
            'name' => 'myTaxCategory',
            'description' => 'TaxCategory 1',
            'rates' => [
                [
                    "name" => "Mwst",
                    "amount" => 0.19,
                    "includedInPrice" => true,
                    "country" => "DE",
                    "state" => "Berlin"
                ]
            ]
        ]);
    }

    public function testMapResult()
    {
        $result = $this->mapResult(TaxCategoryCreateRequest::ofDraft($this->getTaxCategory()));
        $this->assertInstanceOf(TaxCategory::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(TaxCategoryCreateRequest::ofDraft($this->getTaxCategory()));
        $this->assertNull($result);
    }
}
