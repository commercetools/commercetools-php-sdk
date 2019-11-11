<?php
/**
 *
 */

namespace Commercetools\Core\Request\InStores;

use Commercetools\Core\Request\Carts\CartByCustomerIdGetRequest;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartQueryRequest;
use Commercetools\Core\Request\Carts\CartUpdateRequest;
use Commercetools\Core\Request\Customers\CustomerByEmailTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerByKeyGetRequest;
use Commercetools\Core\Request\Customers\CustomerByTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerEmailConfirmRequest;
use Commercetools\Core\Request\Customers\CustomerEmailTokenRequest;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordResetRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordTokenRequest;
use Commercetools\Core\Request\Customers\CustomerQueryRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;
use Commercetools\Core\Request\Me\MeActiveCartRequest;
use Commercetools\Core\Request\Me\MeCartByIdRequest;
use Commercetools\Core\Request\Me\MeCartCreateRequest;
use Commercetools\Core\Request\Me\MeCartDeleteRequest;
use Commercetools\Core\Request\Me\MeCartQueryRequest;
use Commercetools\Core\Request\Me\MeCartUpdateRequest;
use Commercetools\Core\Request\Me\MeOrderByIdRequest;
use Commercetools\Core\Request\Me\MeOrderCreateFromCartRequest;
use Commercetools\Core\Request\Me\MeOrderQueryRequest;
use Commercetools\Core\Request\Orders\OrderByIdGetRequest;
use Commercetools\Core\Request\Orders\OrderByOrderNumberGetRequest;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderQueryRequest;
use Commercetools\Core\Request\Orders\OrderUpdateByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderUpdateRequest;

class InStoreRequests
{
    private $requests = [
        CartByIdGetRequest::class => 1,
        CartByCustomerIdGetRequest::class => 1,
        CartQueryRequest::class => 1,
        CartCreateRequest::class => 1,
        CartUpdateRequest::class => 1,
        CartDeleteRequest::class => 1,
        MeCartByIdRequest::class => 1,
        MeActiveCartRequest::class => 1,
        MeCartQueryRequest::class => 1,
        MeCartCreateRequest::class => 1,
        MeCartUpdateRequest::class => 1,
        MeCartDeleteRequest::class => 1,
        OrderByIdGetRequest::class => 1,
        OrderByOrderNumberGetRequest::class => 1,
        OrderQueryRequest::class => 1,
        OrderCreateFromCartRequest::class => 1,
        OrderUpdateRequest::class => 1,
        OrderUpdateByOrderNumberRequest::class => 1,
        OrderDeleteRequest::class => 1,
        OrderDeleteByOrderNumberRequest::class => 1,
        MeOrderByIdRequest::class => 1,
        MeOrderQueryRequest::class => 1,
        MeOrderCreateFromCartRequest::class => 1,
        CustomerByKeyGetRequest::class => 1,
        CustomerQueryRequest::class => 1,
        CustomerPasswordTokenRequest::class => 1,
        CustomerCreateRequest::class => 1,
        CustomerDeleteRequest::class => 1,
        CustomerByTokenGetRequest::class => 1,
        CustomerPasswordResetRequest::class => 1,
        CustomerLoginRequest::class => 1,
        CustomerEmailTokenRequest::class => 1,
        CustomerByEmailTokenGetRequest::class => 1,
        CustomerEmailConfirmRequest::class => 1,
        CustomerUpdateRequest::class => 1,
        CustomerUpdateByKeyRequest::class => 1,
    ];

    public function can($request)
    {
        return isset($this->requests[$request]);
    }

    public static function of()
    {
        return new static();
    }
}
