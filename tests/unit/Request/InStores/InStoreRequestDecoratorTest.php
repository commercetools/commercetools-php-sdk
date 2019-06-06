<?php
/**
 *
 */

namespace Commercetools\Core\Request\InStores;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerByIdGetRequest;
use Commercetools\Core\Request\Orders\OrderByIdGetRequest;
use Commercetools\Core\RequestTestCase;

class InStoreRequestDecoratorTest extends RequestTestCase
{
    const IN_STORE_REQUEST_DECORATOR = InStoreRequestDecorator::class;

    public function testHttpRequestWithCart()
    {
        $request = CartByIdGetRequest::ofId('cart-id');
        $inStoreRequest = InStoreRequestDecorator::ofStoreKeyAndRequest('store-key', $request);

        $decoratedRequest = $inStoreRequest->httpRequest();
        $this->assertSame('in-store/key=store-key/carts/cart-id', (string)$decoratedRequest->getUri());
    }

    public function testHttpRequestWithOrder()
    {
        $request = OrderByIdGetRequest::ofId('order-id');
        $inStoreRequest = InStoreRequestDecorator::ofStoreKeyAndRequest('store-key', $request);

        $decoratedRequest = $inStoreRequest->httpRequest();
        $this->assertSame('in-store/key=store-key/orders/order-id', (string)$decoratedRequest->getUri());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidRequest()
    {
        $request = CustomerByIdGetRequest::ofId('customer');
        InStoreRequestDecorator::ofStoreKeyAndRequest('store-key', $request);
    }
}
