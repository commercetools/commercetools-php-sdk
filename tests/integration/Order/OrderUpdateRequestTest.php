<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Order;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Order\DeliveryItem;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\OrderState;
use Commercetools\Core\Model\Order\ParcelMeasurements;
use Commercetools\Core\Model\Order\PaymentState;
use Commercetools\Core\Model\Order\ReturnItem;
use Commercetools\Core\Model\Order\ReturnItemCollection;
use Commercetools\Core\Model\Order\ReturnPaymentState;
use Commercetools\Core\Model\Order\ReturnShipmentState;
use Commercetools\Core\Model\Order\ShipmentState;
use Commercetools\Core\Model\Order\TrackingData;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddPaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderRemovePaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderSetBillingAddress;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomerEmail;
use Commercetools\Core\Request\Orders\Command\OrderSetLocaleAction;
use Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetShippingAddress;
use Commercetools\Core\Request\Orders\Command\OrderUpdateSyncInfoAction;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderUpdateRequest;

class OrderUpdateRequestTest extends ApiTestCase
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
        $this->cleanupRequests[] = $cartDeleteRequest = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $orderRequest = OrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
        $response = $orderRequest->executeWithClient($this->getClient());
        $order = $orderRequest->mapResponse($response);
        $this->cleanupRequests[] = $this->deleteRequest = OrderDeleteRequest::ofIdAndVersion(
            $order->getId(),
            $order->getVersion()
        );

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $cartDeleteRequest->setVersion($cart->getVersion());

        return $order;
    }

    public function testChangeState()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $this->assertSame(
            $this->getProduct()->getProductType()->getId(),
            $order->getLineItems()->current()->getProductType()->getId()
        );

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderChangeOrderStateAction::ofOrderState(OrderState::COMPLETE))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame(OrderState::COMPLETE, $result->getOrderState());
    }

    public function testChangeShipmentState()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderChangeShipmentStateAction::ofShipmentState(ShipmentState::SHIPPED))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame(ShipmentState::SHIPPED, $result->getShipmentState());
    }

    public function testChangePaymentState()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderChangePaymentStateAction::ofPaymentState(PaymentState::PAID))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame(PaymentState::PAID, $result->getPaymentState());
    }

    public function testUpdateSyncInfo()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $channel = $this->getChannel(['OrderExport']);
        $syncedAt = new \DateTime();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderUpdateSyncInfoAction::ofChannel($channel->getReference())->setSyncedAt($syncedAt))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame($channel->getId(), $result->getSyncInfo()->current()->getChannel()->getId());
        $syncedAt->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($syncedAt->format('c'), $result->getSyncInfo()->current()->getSyncedAt()->getDateTime()->format('c'));

    }

    public function testReturnInfo()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddReturnInfoAction::of()->setItems(
                    ReturnItemCollection::of()->add(
                        ReturnItem::of()
                            ->setQuantity(1)
                            ->setLineItemId($lineItem->getId())
                            ->setShipmentState(ReturnShipmentState::RETURNED)
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame(
            ReturnShipmentState::RETURNED,
            $result->getReturnInfo()->current()->getItems()->current()->getShipmentState()
        );
        $returnItem = $result->getReturnInfo()->current()->getItems()->current();
        $this->assertSame(
            $lineItem->getId(),
            $returnItem->getLineItemId()
        );
        $order = $result;

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderSetReturnShipmentStateAction::ofReturnItemIdAndShipmentState(
                    $returnItem->getId(),
                    ReturnShipmentState::BACK_IN_STOCK
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $returnItem = $result->getReturnInfo()->current()->getItems()->current();
        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame(
            ReturnShipmentState::BACK_IN_STOCK,
            $returnItem->getShipmentState()
        );
        $order = $result;

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderSetReturnPaymentStateAction::ofReturnItemIdAndPaymentState(
                    $returnItem->getId(),
                    ReturnPaymentState::REFUNDED
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $returnItem = $result->getReturnInfo()->current()->getItems()->current();
        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame(
            ReturnPaymentState::REFUNDED,
            $returnItem->getPaymentState()
        );
    }

    public function testAddDelivery()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddDeliveryAction::ofDeliveryItems(
                    DeliveryItemCollection::of()->add(
                        DeliveryItem::of()->setId($lineItem->getId())->setQuantity(1)
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $delivery = $result->getShippingInfo()->getDeliveries()->current();
        $this->assertSame($lineItem->getId(), $delivery->getItems()->current()->getId());
        $order = $result;

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddParcelToDeliveryAction::ofDeliveryId($delivery->getId())
                    ->setMeasurements(
                        ParcelMeasurements::of()
                            ->setHeightInMillimeter(100)
                            ->setLengthInMillimeter(100)
                            ->setWidthInMillimeter(100)
                            ->setWeightInGram(100)
                    )
                    ->setTrackingData(
                        TrackingData::of()
                            ->setTrackingId('123456')
                            ->setCarrier('DHL')
                            ->setProvider('Schenker')
                            ->setProviderTransaction('abcdef')
                            ->setIsReturn(false)
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $delivery = $result->getShippingInfo()->getDeliveries()->current();
        $this->assertSame(100, $delivery->getParcels()->current()->getMeasurements()->getHeightInMillimeter());
        $this->assertSame('DHL', $delivery->getParcels()->current()->getTrackingData()->getCarrier());
    }

    public function testSetOrderNumber()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $orderNumber = $this->getTestRun() . '-order';
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderSetOrderNumberAction::of()->setOrderNumber($orderNumber))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame($orderNumber, $result->getOrderNumber());
    }

    public function testPayment()
    {
        $draft = $this->getCartDraft();
        $order = $this->createOrder($draft);

        $payment = $this->getPayment();

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderAddPaymentAction::of()->setPayment($payment->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertSame($payment->getId(), $order->getPaymentInfo()->getPayments()->current()->getId());
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderRemovePaymentAction::of()->setPayment($payment->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());
        $this->assertNull($order->getPaymentInfo());
    }

    public function localeProvider()
    {
        return [
            ['en', 'en'],
            ['de', 'de'],
            ['de-de', 'de-DE'],
            ['de-DE', 'de-DE'],
            ['de_de', 'de-DE'],
            ['de_DE', 'de-DE'],
        ];
    }

    /**
     * @dataProvider localeProvider
     */
    public function testLocale($locale, $expectedLocale)
    {
        $draft = $this->getCartDraft();
        $order = $this->createOrder($draft);

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderSetLocaleAction::ofLocale($locale))
        ;
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);

        $this->deleteRequest->setVersion($cart->getVersion());

        $this->assertSame($expectedLocale, $cart->getLocale());
    }

    public function invalidLocaleProvider()
    {
        return [
            ['en-en'],
            ['en_en'],
            ['en_EN'],
            ['en-EN'],
            ['fr'],
        ];
    }

    /**
     * @dataProvider invalidLocaleProvider
     */
    public function testInvalidLocale($locale)
    {
        $draft = $this->getCartDraft();
        $order = $this->createOrder($draft);

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderSetLocaleAction::ofLocale($locale))
        ;
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
    }

    public function testSetCustomerEmail()
    {
        $draft = $this->getCartDraft();
        $order = $this->createOrder($draft);

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderSetCustomerEmail::of()->setEmail($this->getTestRun() . '-new@example.com'))
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertInstanceOf(Order::class, $order);
        $this->assertNotSame($draft->getCustomerEmail(), $order->getCustomerEmail());
    }

    public function testSetShippingAddress()
    {
        $draft = $this->getCartDraft();
        $order = $this->createOrder($draft);

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderSetShippingAddress::of()->setAddress(
                Address::of()->setCountry('DE')->setFirstName($this->getTestRun() . '-new')
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertInstanceOf(Order::class, $order);
        $this->assertNotSame($draft->getShippingAddress()->getFirstName(), $order->getShippingAddress()->getFirstName());
    }

    public function testSetBillingAddress()
    {
        $draft = $this->getCartDraft();
        $order = $this->createOrder($draft);

        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(OrderSetBillingAddress::of()->setAddress(
                Address::of()->setCountry('DE')->setFirstName($this->getTestRun() . '-new')
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertInstanceOf(Order::class, $order);
        $this->assertNotSame($draft->getBillingAddress()->getFirstName(), $order->getBillingAddress()->getFirstName());
    }
}
