<?php
/**
 *
 */

namespace Commercetools\Core;


use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteByKeyRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest;
use Commercetools\Core\Request\DataErasureTrait;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\Orders\OrderDeleteByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteByKeyRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteByKeyRequest;
use Commercetools\Core\Request\Reviews\ReviewDeleteRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteByKeyRequest;
use Commercetools\Core\Request\ShoppingLists\ShoppingListDeleteRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class DataErasureTest extends TestCase
{
    public function getRequests()
    {
        return [
            CartDeleteRequest::class => [ CartDeleteRequest::class, 'ofIdAndVersion' ],
            CustomerDeleteByKeyRequest::class => [ CustomerDeleteByKeyRequest::class, 'ofKeyAndVersion' ],
            CustomerDeleteRequest::class => [ CustomerDeleteRequest::class, 'ofIdAndVersion' ],
            CustomObjectDeleteByKeyRequest::class => [ CustomObjectDeleteByKeyRequest::class, 'ofContainerAndKey' ],
            CustomObjectDeleteRequest::class => [ CustomObjectDeleteRequest::class, 'ofIdAndVersion' ],
            DiscountCodeDeleteRequest::class => [ DiscountCodeDeleteRequest::class, 'ofIdAndVersion' ],
            OrderDeleteByOrderNumberRequest::class => [ OrderDeleteByOrderNumberRequest::class, 'ofOrderNumberAndVersion' ],
            OrderDeleteRequest::class => [ OrderDeleteRequest::class, 'ofIdAndVersion' ],
            PaymentDeleteByKeyRequest::class => [ PaymentDeleteByKeyRequest::class, 'ofKeyAndVersion' ],
            PaymentDeleteRequest::class => [ PaymentDeleteRequest::class, 'ofIdAndVersion' ],
            ReviewDeleteByKeyRequest::class => [ ReviewDeleteByKeyRequest::class, 'ofKeyAndVersion' ],
            ReviewDeleteRequest::class => [ ReviewDeleteRequest::class, 'ofIdAndVersion' ],
            ShoppingListDeleteByKeyRequest::class => [ShoppingListDeleteByKeyRequest::class, 'ofKeyAndVersion'],
            ShoppingListDeleteRequest::class => [ShoppingListDeleteRequest::class, 'ofIdAndVersion']
        ];
    }
    /**
     * @dataProvider getRequests
     */
    public function testDataErasureById($requestClass, $requestFunction)
    {
        /**
         * @var AbstractDeleteRequest|DataErasureTrait $request
         */
        $request = $requestClass::$requestFunction('1234', 1);
        $request->dataErasure(true);
        /**
         * @var RequestInterface $httpRequest
         */
        $httpRequest = $request->httpRequest();

        $this->assertStringStartsWith('dataErasure=true', $httpRequest->getUri()->getQuery());
    }
}
