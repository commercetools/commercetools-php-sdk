<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;


use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\RequestTestCase;

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
                '\Commercetools\Core\Request\CartDiscounts\CartDiscountByIdGetRequest',
                '\Commercetools\Core\Model\CartDiscount\CartDiscount',
            ],
            [
                '\Commercetools\Core\Request\Carts\CartByIdGetRequest',
                '\Commercetools\Core\Model\Cart\Cart',
            ],
            [
                '\Commercetools\Core\Request\Categories\CategoryByIdGetRequest',
                '\Commercetools\Core\Model\Category\Category',
            ],
            [
                '\Commercetools\Core\Request\Channels\ChannelByIdGetRequest',
                '\Commercetools\Core\Model\Channel\Channel',
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest',
                '\Commercetools\Core\Model\CustomerGroup\CustomerGroup',
            ],
            [
                '\Commercetools\Core\Request\Customers\CustomerByIdGetRequest',
                '\Commercetools\Core\Model\Customer\Customer',
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest',
                '\Commercetools\Core\Model\DiscountCode\DiscountCode',
            ],
            [
                '\Commercetools\Core\Request\Inventory\InventoryByIdGetRequest',
                '\Commercetools\Core\Model\Inventory\InventoryEntry',
            ],
            [
                '\Commercetools\Core\Request\Messages\MessageByIdGetRequest',
                '\Commercetools\Core\Model\Message\Message',
            ],
            [
                '\Commercetools\Core\Request\Orders\OrderByIdGetRequest',
                '\Commercetools\Core\Model\Order\Order',
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountByIdGetRequest',
                '\Commercetools\Core\Model\ProductDiscount\ProductDiscount',
            ],
            [
                '\Commercetools\Core\Request\Products\ProductByIdGetRequest',
                '\Commercetools\Core\Model\Product\Product',
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeByIdGetRequest',
                '\Commercetools\Core\Model\ProductType\ProductType',
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewByIdGetRequest',
                '\Commercetools\Core\Model\Review\Review',
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest',
                '\Commercetools\Core\Model\ShippingMethod\ShippingMethod',
            ],
            [
                '\Commercetools\Core\Request\States\StateByIdGetRequest',
                '\Commercetools\Core\Model\State\State',
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\TaxCategoryByIdGetRequest',
                '\Commercetools\Core\Model\TaxCategory\TaxCategory',
            ],
            [
                '\Commercetools\Core\Request\Zones\ZoneByIdGetRequest',
                '\Commercetools\Core\Model\Zone\Zone',
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest',
                '\Commercetools\Core\Model\ShippingMethod\ShippingMethod',
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
