<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\RequestTestCase;

class GenericFetchByIdRequestTest extends RequestTestCase
{
    /**
     * @param $className
     * @param array $args
     * @return AbstractApiRequest
     */
    protected function getRequest($className, array $args = [])
    {
        $request = call_user_func_array($className . '::ofId', $args);

        return $request;
    }

    public function mapResultProvider()
    {
        return [
            [
                '\Sphere\Core\Request\CartDiscounts\CartDiscountFetchByIdRequest',
                '\Sphere\Core\Model\CartDiscount\CartDiscount',
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
                '\Sphere\Core\Model\Channel\Channel',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentFetchByIdRequest',
                '\Sphere\Core\Model\Comment\Comment',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupFetchByIdRequest',
                '\Sphere\Core\Model\CustomerGroup\CustomerGroup',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerFetchByIdRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeFetchByIdRequest',
                '\Sphere\Core\Model\DiscountCode\DiscountCode',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryFetchByIdRequest',
                '\Sphere\Core\Model\Inventory\InventoryEntry',
            ],
            [
                '\Sphere\Core\Request\Messages\MessageFetchByIdRequest',
                '\Sphere\Core\Model\Message\Message',
            ],
            [
                '\Sphere\Core\Request\Orders\OrderFetchByIdRequest',
                '\Sphere\Core\Model\Order\Order',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountFetchByIdRequest',
                '\Sphere\Core\Model\ProductDiscount\ProductDiscount',
            ],
            [
                '\Sphere\Core\Request\Products\ProductFetchByIdRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeFetchByIdRequest',
                '\Sphere\Core\Model\ProductType\ProductType',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewFetchByIdRequest',
                '\Sphere\Core\Model\Review\Review',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodFetchByIdRequest',
                '\Sphere\Core\Model\ShippingMethod\ShippingMethod',
            ],
            [
                '\Sphere\Core\Request\States\StateFetchByIdRequest',
                '\Sphere\Core\Model\State\State',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryFetchByIdRequest',
                '\Sphere\Core\Model\TaxCategory\TaxCategory',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneFetchByIdRequest',
                '\Sphere\Core\Model\Zone\Zone',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodFetchByIdRequest',
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
