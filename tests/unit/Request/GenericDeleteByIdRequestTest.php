<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Request\AbstractApiRequest;
use Sphere\Core\RequestTestCase;

class GenericDeleteByIdRequestTest extends RequestTestCase
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
                '\Sphere\Core\Request\CartDiscounts\CartDiscountDeleteByIdRequest',
                '\Sphere\Core\Model\CartDiscount\CartDiscount',
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
                '\Sphere\Core\Model\Channel\Channel',
            ],
            [
                '\Sphere\Core\Request\CustomerGroups\CustomerGroupDeleteByIdRequest',
                '\Sphere\Core\Model\CustomerGroup\CustomerGroup',
            ],
            [
                '\Sphere\Core\Request\Customers\CustomerDeleteByIdRequest',
                '\Sphere\Core\Model\Customer\Customer',
            ],
            [
                '\Sphere\Core\Request\DiscountCodes\DiscountCodeDeleteByIdRequest',
                '\Sphere\Core\Model\DiscountCode\DiscountCode',
            ],
            [
                '\Sphere\Core\Request\Inventory\InventoryDeleteByIdRequest',
                '\Sphere\Core\Model\Inventory\InventoryEntry',
            ],
            [
                '\Sphere\Core\Request\ProductDiscounts\ProductDiscountDeleteByIdRequest',
                '\Sphere\Core\Model\ProductDiscount\ProductDiscount',
            ],
            [
                '\Sphere\Core\Request\Products\ProductDeleteByIdRequest',
                '\Sphere\Core\Model\Product\Product',
            ],
            [
                '\Sphere\Core\Request\ProductTypes\ProductTypeDeleteByIdRequest',
                '\Sphere\Core\Model\ProductType\ProductType',
            ],
            [
                '\Sphere\Core\Request\States\StateDeleteByIdRequest',
                '\Sphere\Core\Model\State\State',
            ],
            [
                '\Sphere\Core\Request\TaxCategories\TaxCategoryDeleteByIdRequest',
                '\Sphere\Core\Model\TaxCategory\TaxCategory',
            ],
            [
                '\Sphere\Core\Request\Zones\ZoneDeleteByIdRequest',
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
