<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories;


use Sphere\Core\Model\TaxCategory\TaxCategoryDraft;
use Sphere\Core\RequestTestCase;

class TaxCategoryCreateRequestTest extends RequestTestCase
{
    const TAX_CATEGORY_CREATE_REQUEST = '\Sphere\Core\Request\TaxCategories\TaxCategoryCreateRequest';

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
        $this->assertInstanceOf('\Sphere\Core\Model\TaxCategory\TaxCategory', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(TaxCategoryCreateRequest::ofDraft($this->getTaxCategory()));
        $this->assertNull($result);
    }
}
