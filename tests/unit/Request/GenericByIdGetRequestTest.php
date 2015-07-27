<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\RequestTestCase;

class GenericByIdGetRequestTest extends RequestTestCase
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
                '\Sphere\Core\Request\CartDiscounts\CartDiscountByIdGetRequest',
                '\Sphere\Core\Model\CartDiscount\CartDiscount',
            ],
            [
                '\Sphere\Core\Request\Carts\CartByIdGetRequest',
                '\Sphere\Core\Model\Cart\Cart',
            ],
            [
                '\Sphere\Core\Request\Categories\CategoryByIdGetRequest',
                '\Sphere\Core\Model\Category\Category',
            ],
            [
                '\Sphere\Core\Request\Channels\ChannelByIdGetRequest',
                '\Sphere\Core\Model\Channel\Channel',
            ],
            [
                '\Sphere\Core\Request\Comments\CommentByIdGetRequest',
                '\Sphere\Core\Model\Comment\Comment',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest',
                '\Sphere\Core\Model\CustomerGroup\CustomerGroup',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerByIdGetRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest',
                '\Sphere\Core\Model\DiscountCode\DiscountCode',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryByIdGetRequest',
                '\Sphere\Core\Model\Inventory\InventoryEntry',
            ],
            [
                '\Sphere\Core\Request\Messages\MessageByIdGetRequest',
                '\Sphere\Core\Model\Message\Message',
            ],
            [
                '\Sphere\Core\Request\Orders\OrderByIdGetRequest',
                '\Sphere\Core\Model\Order\Order',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountByIdGetRequest',
                '\Sphere\Core\Model\ProductDiscount\ProductDiscount',
            ],
            [
                '\Sphere\Core\Request\Products\ProductByIdGetRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeByIdGetRequest',
                '\Sphere\Core\Model\ProductType\ProductType',
            ],
            [
                '\Sphere\Core\Request\Reviews\ReviewByIdGetRequest',
                '\Sphere\Core\Model\Review\Review',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest',
                '\Sphere\Core\Model\ShippingMethod\ShippingMethod',
            ],
            [
                '\Sphere\Core\Request\States\StateByIdGetRequest',
                '\Sphere\Core\Model\State\State',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryByIdGetRequest',
                '\Sphere\Core\Model\TaxCategory\TaxCategory',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneByIdGetRequest',
                '\Sphere\Core\Model\Zone\Zone',
            ],
            [
                '\Sphere\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest',
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
