<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\RequestTestCase;

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
                '\Commercetools\Core\Request\CartDiscounts\CartDiscountUpdateRequest',
                '\Commercetools\Core\Model\CartDiscount\CartDiscount',
            ],
            [
                '\Commercetools\Core\Request\Carts\CartUpdateRequest',
                '\Commercetools\Core\Model\Cart\Cart',
            ],
            [
                '\Commercetools\Core\Request\Categories\CategoryUpdateRequest',
                '\Commercetools\Core\Model\Category\Category',
            ],
            [
                '\Commercetools\Core\Request\Channels\ChannelUpdateRequest',
                '\Commercetools\Core\Model\Channel\Channel',
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateRequest',
                '\Commercetools\Core\Model\CustomerGroup\CustomerGroup',
            ],
            [
                '\Commercetools\Core\Request\Customers\CustomerUpdateRequest',
                '\Commercetools\Core\Model\Customer\Customer',
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\DiscountCodeUpdateRequest',
                '\Commercetools\Core\Model\DiscountCode\DiscountCode',
            ],
            [
                '\Commercetools\Core\Request\Inventory\InventoryUpdateRequest',
                '\Commercetools\Core\Model\Inventory\InventoryEntry',
            ],
            [
                '\Commercetools\Core\Request\Orders\OrderUpdateRequest',
                '\Commercetools\Core\Model\Order\Order',
            ],
            [
                '\Commercetools\Core\Request\Payments\PaymentUpdateRequest',
                '\Commercetools\Core\Model\Payment\Payment',
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateRequest',
                '\Commercetools\Core\Model\ProductDiscount\ProductDiscount',
            ],
            [
                '\Commercetools\Core\Request\Products\ProductUpdateRequest',
                '\Commercetools\Core\Model\Product\Product',
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeUpdateRequest',
                '\Commercetools\Core\Model\ProductType\ProductType',
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewUpdateRequest',
                '\Commercetools\Core\Model\Review\Review',
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateRequest',
                '\Commercetools\Core\Model\ShippingMethod\ShippingMethod',
            ],
            [
                '\Commercetools\Core\Request\States\StateUpdateRequest',
                '\Commercetools\Core\Model\State\State',
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateRequest',
                '\Commercetools\Core\Model\TaxCategory\TaxCategory',
            ],
            [
                '\Commercetools\Core\Request\Types\TypeUpdateRequest',
                '\Commercetools\Core\Model\Type\Type',
            ],
            [
                '\Commercetools\Core\Request\Zones\ZoneUpdateRequest',
                '\Commercetools\Core\Model\Zone\Zone',
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
