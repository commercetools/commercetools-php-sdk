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
use Commercetools\Core\Request\CartDiscounts\CartDiscountByIdGetRequest;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Categories\CategoryByIdGetRequest;
use Commercetools\Core\Request\Channels\ChannelByIdGetRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerByIdGetRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest;
use Commercetools\Core\Request\Inventory\InventoryByIdGetRequest;
use Commercetools\Core\Request\Messages\MessageByIdGetRequest;
use Commercetools\Core\Request\Orders\OrderByIdGetRequest;
use Commercetools\Core\Request\Payments\PaymentByIdGetRequest;
use Commercetools\Core\Request\ProductDiscounts\ProductDiscountByIdGetRequest;
use Commercetools\Core\Request\Products\ProductByIdGetRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeByIdGetRequest;
use Commercetools\Core\Request\Reviews\ReviewByIdGetRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodByIdGetRequest;
use Commercetools\Core\Request\States\StateByIdGetRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryByIdGetRequest;
use Commercetools\Core\Request\Types\TypeByIdGetRequest;
use Commercetools\Core\Request\Zones\ZoneByIdGetRequest;
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
                CartDiscountByIdGetRequest::class,
                CartDiscount::class,
            ],
            [
                CartByIdGetRequest::class,
                Cart::class,
            ],
            [
                CategoryByIdGetRequest::class,
                Category::class,
            ],
            [
                ChannelByIdGetRequest::class,
                Channel::class,
            ],
            [
                CustomerGroupByIdGetRequest::class,
                CustomerGroup::class,
            ],
            [
                CustomerByIdGetRequest::class,
                Customer::class,
            ],
            [
                DiscountCodeByIdGetRequest::class,
                DiscountCode::class,
            ],
            [
                InventoryByIdGetRequest::class,
                InventoryEntry::class,
            ],
            [
                MessageByIdGetRequest::class,
                Message::class,
            ],
            [
                OrderByIdGetRequest::class,
                Order::class,
            ],
            [
                PaymentByIdGetRequest::class,
                Payment::class,
            ],
            [
                ProductDiscountByIdGetRequest::class,
                ProductDiscount::class,
            ],
            [
                ProductByIdGetRequest::class,
                Product::class,
            ],
            [
                ProductTypeByIdGetRequest::class,
                ProductType::class,
            ],
            [
                ReviewByIdGetRequest::class,
                Review::class,
            ],
            [
                ShippingMethodByIdGetRequest::class,
                ShippingMethod::class,
            ],
            [
                StateByIdGetRequest::class,
                State::class,
            ],
            [
                TaxCategoryByIdGetRequest::class,
                TaxCategory::class,
            ],
            [
                TypeByIdGetRequest::class,
                Type::class,
            ],
            [
                ZoneByIdGetRequest::class,
                Zone::class,
            ],
            [
                ShippingMethodByIdGetRequest::class,
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
