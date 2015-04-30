<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\RequestTestCase;

class GenericFetchByIdRequestTest extends RequestTestCase
{
    public function mapResultProvider()
    {
        return [
            [
                '\Sphere\Core\Request\CartDiscounts\CartDiscountFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Carts\CartFetchByIdRequest',
                '\Sphere\Core\Model\Cart\Cart',
            ],
            [
                '\Sphere\Core\Request\Categories\CategoryFetchByIdRequest',
                '\Sphere\Core\Model\Category\Category',
            ],
            [
                '\Sphere\Core\Request\Channels\ChannelFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerFetchByIdRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Messages\MessageFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Orders\OrderFetchByIdRequest',
                '\Sphere\Core\Model\Order\Order',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Products\ProductFetchByIdRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\States\StateFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryFetchByIdRequest',
                '\Sphere\Core\Model\Common\JsonObject',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneFetchByIdRequest',
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
        $result = $this->mapResult($requestClass, ['id']);
        $this->assertInstanceOf($resultClass, $result);
    }

    /**
     * @dataProvider mapResultProvider
     * @param $requestClass
     * @param $resultClass
     */
    public function testMapEmptyResult($requestClass, $resultClass)
    {
        $result = $this->mapEmptyResult($requestClass, ['id']);
        $this->assertNull($result);
    }
}
