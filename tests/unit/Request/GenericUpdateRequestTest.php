<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\RequestTestCase;

class GenericUpdateRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofIdAndVersion', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            [
                '\Sphere\Core\Request\CartDiscounts\CartDiscountUpdateRequest',
                '\Sphere\Core\Model\CartDiscount\CartDiscount',
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
                '\Sphere\Core\Model\Channel\Channel',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentUpdateRequest',
                '\Sphere\Core\Model\Comment\Comment',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupUpdateRequest',
                '\Sphere\Core\Model\CustomerGroup\CustomerGroup',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerUpdateRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeUpdateRequest',
                '\Sphere\Core\Model\DiscountCode\DiscountCode',
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
                '\Sphere\Core\Model\ProductDiscount\ProductDiscount',
            ],
            [
                '\Sphere\Core\Request\Products\ProductUpdateRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeUpdateRequest',
                '\Sphere\Core\Model\ProductType\ProductType',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewUpdateRequest',
                '\Sphere\Core\Model\Review\Review',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodUpdateRequest',
                '\Sphere\Core\Model\ShippingMethod\ShippingMethod',
            ],
            [
                '\Sphere\Core\Request\States\StateUpdateRequest',
                '\Sphere\Core\Model\State\State',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryUpdateRequest',
                '\Sphere\Core\Model\TaxCategory\TaxCategory',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneUpdateRequest',
                '\Sphere\Core\Model\Zone\Zone',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodUpdateRequest',
                '\Sphere\Core\Model\ShippingMethod\ShippingMethod',
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
