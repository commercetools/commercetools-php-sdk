<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Order;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Orders\OrderByIdGetRequest;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderQueryRequest;

class OrderQueryRequestTest extends ApiTestCase
{
    /**
     * @return CartDraft
     */
    protected function getCartDraft()
    {
        $draft = CartDraft::ofCurrency(
            'EUR'
        );
        /**
         * @var Customer $customer
         */
        $customer = $this->getCustomer();
        $draft->setCustomerId($customer->getId())
            ->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setCountry('DE')
            ->setLineItems(
                LineItemDraftCollection::of()
                    ->add(
                        LineItemDraft::of()
                            ->setProductId($this->getProduct()->getId())
                            ->setVariantId(1)
                            ->setQuantity(1)
                    )
            )
            ->setShippingMethod($this->getShippingMethod()->getReference())
        ;

        return $draft;
    }

    protected function createOrder(CartDraft $draft)
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $orderRequest = OrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
        $response = $orderRequest->executeWithClient($this->getClient());
        $order = $orderRequest->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = OrderDeleteRequest::ofIdAndVersion(
            $order->getId(),
            $order->getVersion()
        );

        $cartRequest = CartByIdGetRequest::ofId($cart->getId());
        $response = $cartRequest->executeWithClient($this->getClient());
        $cart = $cartRequest->mapResponse($response);

        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        return $order;
    }

    public function testGetById()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $request = OrderByIdGetRequest::ofId($order->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame($order->getId(), $result->getId());
    }

    public function testQuery()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $request = OrderQueryRequest::of()->where(
            'customerEmail="' . $cartDraft->getCustomerEmail() . '"'
        );

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(Order::class, $result->getAt(0));
        $this->assertSame($order->getId(), $result->getAt(0)->getId());
    }
}
