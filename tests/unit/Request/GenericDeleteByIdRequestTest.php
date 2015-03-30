<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\RequestTestCase;

class GenericDeleteByIdRequestTest extends RequestTestCase
{
    public function mapResultProvider()
    {
        return [
            [
                '\Sphere\Core\Request\CartDiscounts\CartDiscountDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Carts\CartDeleteByIdRequest',
                '\Sphere\Core\Model\Cart\Cart',
            ],
            [
                '\Sphere\Core\Request\Categories\CategoryDeleteByIdRequest',
                '\Sphere\Core\Model\Category\Category',
            ],
            [
                '\Sphere\Core\Request\Channels\ChannelDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerDeleteByIdRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Products\ProductDeleteByIdRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\States\StateDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneDeleteByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
        ];
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapResult($requestClass, $resultClass)
    {
        $result = $this->mapResult($requestClass, ['id', 1]);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['id', 1]);
        $this->assertNull($result);
    }
}
