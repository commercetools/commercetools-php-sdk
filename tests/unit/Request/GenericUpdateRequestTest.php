<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\Category\Category;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\Review\Review;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Zone\Zone;
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
                CartDiscount::class,
            ],
            [
                '\Commercetools\Core\Request\Carts\CartUpdateRequest',
                Cart::class,
            ],
            [
                '\Commercetools\Core\Request\Categories\CategoryUpdateRequest',
                Category::class,
            ],
            [
                '\Commercetools\Core\Request\Channels\ChannelUpdateRequest',
                Channel::class,
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\CustomerGroupUpdateRequest',
                CustomerGroup::class,
            ],
            [
                '\Commercetools\Core\Request\Customers\CustomerUpdateRequest',
                Customer::class,
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\DiscountCodeUpdateRequest',
                DiscountCode::class,
            ],
            [
                '\Commercetools\Core\Request\Inventory\InventoryUpdateRequest',
                InventoryEntry::class,
            ],
            [
                '\Commercetools\Core\Request\Orders\OrderUpdateRequest',
                Order::class,
            ],
            [
                '\Commercetools\Core\Request\Payments\PaymentUpdateRequest',
                Payment::class,
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountUpdateRequest',
                ProductDiscount::class,
            ],
            [
                '\Commercetools\Core\Request\Products\ProductUpdateRequest',
                Product::class,
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeUpdateRequest',
                ProductType::class,
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewUpdateRequest',
                Review::class,
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodUpdateRequest',
                ShippingMethod::class,
            ],
            [
                '\Commercetools\Core\Request\States\StateUpdateRequest',
                State::class,
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateRequest',
                TaxCategory::class,
            ],
            [
                '\Commercetools\Core\Request\Types\TypeUpdateRequest',
                Type::class,
            ],
            [
                '\Commercetools\Core\Request\Zones\ZoneUpdateRequest',
                Zone::class,
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
