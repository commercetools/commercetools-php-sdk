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
use Commercetools\Core\Model\Message\Message;
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
                CartDiscount::class,
            ],
            [
                '\Commercetools\Core\Request\Carts\CartByIdGetRequest',
                Cart::class,
            ],
            [
                '\Commercetools\Core\Request\Categories\CategoryByIdGetRequest',
                Category::class,
            ],
            [
                '\Commercetools\Core\Request\Channels\ChannelByIdGetRequest',
                Channel::class,
            ],
            [
                '\Commercetools\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest',
                CustomerGroup::class,
            ],
            [
                '\Commercetools\Core\Request\Customers\CustomerByIdGetRequest',
                Customer::class,
            ],
            [
                '\Commercetools\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest',
                DiscountCode::class,
            ],
            [
                '\Commercetools\Core\Request\Inventory\InventoryByIdGetRequest',
                InventoryEntry::class,
            ],
            [
                '\Commercetools\Core\Request\Messages\MessageByIdGetRequest',
                Message::class,
            ],
            [
                '\Commercetools\Core\Request\Orders\OrderByIdGetRequest',
                Order::class,
            ],
            [
                '\Commercetools\Core\Request\Payments\PaymentByIdGetRequest',
                Payment::class,
            ],
            [
                '\Commercetools\Core\Request\ProductDiscounts\ProductDiscountByIdGetRequest',
                ProductDiscount::class,
            ],
            [
                '\Commercetools\Core\Request\Products\ProductByIdGetRequest',
                Product::class,
            ],
            [
                '\Commercetools\Core\Request\ProductTypes\ProductTypeByIdGetRequest',
                ProductType::class,
            ],
            [
                '\Commercetools\Core\Request\Reviews\ReviewByIdGetRequest',
                Review::class,
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest',
                ShippingMethod::class,
            ],
            [
                '\Commercetools\Core\Request\States\StateByIdGetRequest',
                State::class,
            ],
            [
                '\Commercetools\Core\Request\TaxCategories\TaxCategoryByIdGetRequest',
                TaxCategory::class,
            ],
            [
                '\Commercetools\Core\Request\Types\TypeByIdGetRequest',
                Type::class,
            ],
            [
                '\Commercetools\Core\Request\Zones\ZoneByIdGetRequest',
                Zone::class,
            ],
            [
                '\Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest',
                ShippingMethod::class,
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
