<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\RequestTestCase;

class GenericUpdateRequestTest extends RequestTestCase
{

    public function mapResultProvider()
    {
        return [
            [
                '\Sphere\Core\Request\CartDiscounts\CartDiscountUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Carts\CartUpdateRequest',
                '\Sphere\Core\Model\Cart\Cart',
            ],
            [
                '\Sphere\Core\Request\Categories\CategoryUpdateRequest',
                '\Sphere\Core\Model\Category\Category',
            ],
            [
                '\Sphere\Core\Request\Channels\ChannelUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerUpdateRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryUpdateRequest',
                '\Sphere\Core\Model\Inventory\InventoryEntry',
            ],
            [
                '\Sphere\Core\Request\Orders\OrderUpdateRequest',
                '\Sphere\Core\Model\Order\Order',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Products\ProductUpdateRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\States\StateUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryUpdateRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneUpdateRequest',
                '\Sphere\Core\Model\Zone\Zone',
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
