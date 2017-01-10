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
use Commercetools\Core\Model\CustomObject\CustomObject;
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
                '\Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest',
                CartDiscount::class,
            ],
            [
                '\Commercetools\Core\Request\Carts\CartDeleteRequest',
                Cart::class,
            ],
            [
                '\Commercetools\Core\Request\Categories\CategoryDeleteRequest',
                Category::class,
            ],
            [
                '\Commercetools\Core\Request\Channels\ChannelDeleteRequest',
                Channel::class,
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest',
                CustomerGroup::class,
            ],
            [
                '\Commercetools\Core\Request\Customers\CustomerDeleteRequest',
                Customer::class,
            ],
            [
                '\Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest',
                CustomObject::class,
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest',
                DiscountCode::class,
            ],
            [
                '\Commercetools\Core\Request\Inventory\InventoryDeleteRequest',
                InventoryEntry::class,
            ],
            [
                '\Commercetools\Core\Request\Orders\OrderDeleteRequest',
                Order::class,
            ],
            [
                '\Commercetools\Core\Request\Payments\PaymentDeleteRequest',
                Payment::class,
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountDeleteRequest',
                ProductDiscount::class,
            ],
            [
                '\Commercetools\Core\Request\Products\ProductDeleteRequest',
                Product::class,
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest',
                ProductType::class,
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewDeleteRequest',
                Review::class,
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest',
                ShippingMethod::class,
            ],
            [
                '\Commercetools\Core\Request\States\StateDeleteRequest',
                State::class,
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest',
                TaxCategory::class,
            ],
            [
                '\Commercetools\Core\Request\Types\TypeDeleteRequest',
                Type::class,
            ],
            [
                '\Commercetools\Core\Request\Zones\ZoneDeleteRequest',
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
