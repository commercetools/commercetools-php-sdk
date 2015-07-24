<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\RequestTestCase;

class GenericDeleteRequestTest extends RequestTestCase
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
                '\Sphere\Core\Request\CartDiscounts\CartDiscountDeleteRequest',
                '\Sphere\Core\Model\CartDiscount\CartDiscount',
            ],
            [
                '\Sphere\Core\Request\Carts\CartDeleteRequest',
                '\Sphere\Core\Model\Cart\Cart',
            ],
            [
                '\Sphere\Core\Request\Categories\CategoryDeleteRequest',
                '\Sphere\Core\Model\Category\Category',
            ],
            [
                '\Sphere\Core\Request\Channels\ChannelDeleteRequest',
                '\Sphere\Core\Model\Channel\Channel',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupDeleteRequest',
                '\Sphere\Core\Model\CustomerGroup\CustomerGroup',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerDeleteRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeDeleteRequest',
                '\Sphere\Core\Model\DiscountCode\DiscountCode',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryDeleteRequest',
                '\Sphere\Core\Model\Inventory\InventoryEntry',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest',
                '\Sphere\Core\Model\ProductDiscount\ProductDiscount',
            ],
            [
                '\Sphere\Core\Request\Products\ProductDeleteRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeDeleteRequest',
                '\Sphere\Core\Model\ProductType\ProductType',
            ],
            [
                '\Sphere\Core\Request\States\StateDeleteRequest',
                '\Sphere\Core\Model\State\State',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryDeleteRequest',
                '\Sphere\Core\Model\TaxCategory\TaxCategory',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneDeleteRequest',
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
