<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Order;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Cart\CartState;
use Commercetools\Core\Model\Cart\CustomLineItemDraft;
use Commercetools\Core\Model\Cart\CustomLineItemDraftCollection;
use Commercetools\Core\Model\Cart\LineItemDraft;
use Commercetools\Core\Model\Cart\LineItemDraftCollection;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\PriceDraft;
use Commercetools\Core\Model\Common\PriceDraftCollection;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Order\DeliveryItem;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\OrderState;
use Commercetools\Core\Model\Order\Parcel;
use Commercetools\Core\Model\Order\ParcelCollection;
use Commercetools\Core\Model\Order\ParcelMeasurements;
use Commercetools\Core\Model\Order\PaymentState;
use Commercetools\Core\Model\Order\ReturnItem;
use Commercetools\Core\Model\Order\ReturnItemCollection;
use Commercetools\Core\Model\Order\ReturnPaymentState;
use Commercetools\Core\Model\Order\ReturnShipmentState;
use Commercetools\Core\Model\Order\ShipmentState;
use Commercetools\Core\Model\Order\TrackingData;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\Product\ProductVariantDraft;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartReplicateRequest;
use Commercetools\Core\Request\Orders\Command\OrderAddDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddParcelToDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderAddPaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderAddReturnInfoAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeOrderStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangePaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderChangeShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderRemoveDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderRemoveParcelFromDeliveryAction;
use Commercetools\Core\Request\Orders\Command\OrderRemovePaymentAction;
use Commercetools\Core\Request\Orders\Command\OrderSetBillingAddress;
use Commercetools\Core\Request\Orders\Command\OrderSetCustomerEmail;
use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryAddressAction;
use Commercetools\Core\Request\Orders\Command\OrderSetDeliveryItemsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetLocaleAction;
use Commercetools\Core\Request\Orders\Command\OrderSetOrderNumberAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelItemsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelMeasurementsAction;
use Commercetools\Core\Request\Orders\Command\OrderSetParcelTrackingDataAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnPaymentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetReturnShipmentStateAction;
use Commercetools\Core\Request\Orders\Command\OrderSetShippingAddress;
use Commercetools\Core\Request\Orders\Command\OrderUpdateSyncInfoAction;
use Commercetools\Core\Request\Orders\OrderByOrderNumberGetRequest;
use Commercetools\Core\Request\Orders\OrderCreateFromCartRequest;
use Commercetools\Core\Request\Orders\OrderDeleteByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderUpdateByOrderNumberRequest;
use Commercetools\Core\Request\Orders\OrderUpdateRequest;
use Commercetools\Core\Request\Products\Command\ProductUnpublishAction;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;

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

    protected function createOrder(
        CartDraft $draft,
        $orderNumber = null,
        $paymentState = null,
        $orderState= null,
        $state = null,
        $shipmentState = null
    )
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = $cartDeleteRequest = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        $orderRequest = OrderCreateFromCartRequest::ofCartIdAndVersion($cart->getId(), $cart->getVersion());
        if (!is_null($orderNumber)) {
            $orderRequest->setOrderNumber($orderNumber);
        }
        if (!is_null($paymentState)) {
            $orderRequest->setPaymentState($paymentState);
        }
        if (!is_null($orderState)) {
            $orderRequest->setOrderState($orderState);
        }
        if (!is_null($state)) {
            $orderRequest->setState($state);
        }
        if (!is_null($shipmentState)) {
            $orderRequest->setShipmentState($shipmentState);
        }
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

    public function testOrderByOrderNumber()
    {
        $cartDraft = $this->getCartDraft();
        $orderNumber = (new \DateTime())->format('Y/m/d') . ' ' . $this->getTestRun();
        $this->createOrder($cartDraft, $orderNumber);

        $request = OrderByOrderNumberGetRequest::ofOrderNumber($orderNumber);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(Order::class, $result);
    }

    public function testUpdateOrderByOrderNumber()
    {
        $cartDraft = $this->getCartDraft();
        $orderNumber = (new \DateTime())->format('Y/m/d') . ' ' . $this->getTestRun();
        $order = $this->createOrder($cartDraft, $orderNumber);

        $this->assertSame(
            $this->getProduct()->getProductType()->getId(),
            $order->getLineItems()->current()->getProductType()->getId()
        );

        $request = OrderUpdateByOrderNumberRequest::ofOrderNumberAndVersion($orderNumber, $order->getVersion())
            ->addAction(OrderChangeOrderStateAction::ofOrderState(OrderState::COMPLETE))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertSame(OrderState::COMPLETE, $result->getOrderState());
    }

    public function testDeleteOrderByOrderNumber()
    {
        $cartDraft = $this->getCartDraft();
        $orderNumber = (new \DateTime())->format('Y/m/d') . ' ' . $this->getTestRun();
        $order = $this->createOrder($cartDraft, $orderNumber);

        $request = OrderDeleteByOrderNumberRequest::ofOrderNumberAndVersion($orderNumber, $order->getVersion());
        $response = $request->executeWithClient($this->getClient());

        $result = $request->mapResponse($response);

        $this->assertFalse($response->isError());
        $this->assertInstanceOf(Order::class, $result);
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
                )->setAddress(Address::of()->setCountry('DE'))
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
                    ->setItems(
                        DeliveryItemCollection::of()->add(
                            DeliveryItem::of()->setId($lineItem->getId())->setQuantity(3)
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
        $this->assertSame('DE', $delivery->getAddress()->getCountry());
        $this->assertSame(100, $delivery->getParcels()->current()->getMeasurements()->getHeightInMillimeter());
        $this->assertSame('DHL', $delivery->getParcels()->current()->getTrackingData()->getCarrier());
    }

    public function testDeliverySetAddress()
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
                OrderSetDeliveryAddressAction::ofDeliveryId($delivery->getId())->setAddress(
                    Address::of()->setCountry('DE')
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $delivery = $result->getShippingInfo()->getDeliveries()->current();
        $this->assertSame('DE', $delivery->getAddress()->getCountry());
    }

    public function testRemoveDelivery()
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
                OrderRemoveDeliveryAction::ofDelivery($delivery->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $this->assertCount(0, $result->getShippingInfo()->getDeliveries());
    }

    public function testSetDeliveryItems()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddDeliveryAction::of()
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertNotSame($order->getVersion(), $result->getVersion());
        $this->assertInstanceOf(Order::class, $result);
        $order = $result;

        $delivery = $order->getShippingInfo()->getDeliveries()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderSetDeliveryItemsAction::ofDeliveryAndItems(
                    $delivery->getId(),
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

    public function testAddDeliveryWithParcel()
    {
        $taxCategory = $this->getTaxCategory();
        $cartDraft = $this->getCartDraft();

        $product2 = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2')
        )
            ->setMasterVariant(
                ProductVariantDraft::of()->setSku('test-' . $this->getTestRun() . '-sku2')
                    ->setPrices(
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                ->setCountry('DE')
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
            ->setPublish(true)
        ;

        $request = ProductCreateRequest::ofDraft($product2);
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $cartDraft->getLineItems()->add(LineItemDraft::ofSku($product2->getMasterData()->getCurrent()->getMasterVariant()->getSku())->setQuantity(1));

        $cartDraft->setCustomLineItems(
            CustomLineItemDraftCollection::of()->add(
                CustomLineItemDraft::of()
                    ->setName(LocalizedString::ofLangAndText('en', 'test'))
                    ->setSlug('test')
                    ->setQuantity(1)
                    ->setMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    ->setTaxCategory($taxCategory->getReference())
            )
        );
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->getAt(0);
        $lineItem2 = $order->getLineItems()->getAt(1);
        $customLineItem = $order->getCustomLineItems()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddDeliveryAction::of()
                    ->setParcels(
                        ParcelCollection::of()->add(
                            Parcel::of()->setItems(
                                DeliveryItemCollection::of()->add(
                                    DeliveryItem::of()
                                        ->setId($lineItem->getId())
                                        ->setQuantity(2)
                                )->add(
                                    DeliveryItem::of()
                                        ->setId($customLineItem->getId())
                                        ->setQuantity(1)
                                )->add(
                                    DeliveryItem::of()
                                        ->setId($lineItem2->getId())
                                        ->setQuantity(10)
                                )
                            )
                        )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertCount(
            3,
            $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current()->getItems()
        );


        $request = ProductUpdateRequest::ofIdAndVersion($product2->getId(), $product2->getVersion())
            ->addAction(ProductUnpublishAction::of());
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $request = ProductDeleteRequest::ofIdAndVersion(
            $product2->getId(),
            $product2->getVersion()
        );
        $request->executeWithClient($this->getClient());
    }

    public function testSetParcelItems()
    {
        $taxCategory = $this->getTaxCategory();
        $cartDraft = $this->getCartDraft();

        $product2 = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2')
        )
            ->setMasterVariant(
                ProductVariantDraft::of()->setSku('test-' . $this->getTestRun() . '-sku2')
                    ->setPrices(
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                ->setCountry('DE')
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
            ->setPublish(true)
        ;

        $request = ProductCreateRequest::ofDraft($product2);
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $cartDraft->getLineItems()->add(LineItemDraft::ofSku($product2->getMasterData()->getCurrent()->getMasterVariant()->getSku())->setQuantity(1));

        $cartDraft->setCustomLineItems(
            CustomLineItemDraftCollection::of()->add(
                CustomLineItemDraft::of()
                    ->setName(LocalizedString::ofLangAndText('en', 'test'))
                    ->setSlug('test')
                    ->setQuantity(1)
                    ->setMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    ->setTaxCategory($taxCategory->getReference())
            )
        );
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->getAt(0);
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddDeliveryAction::of()->setParcels(
                    ParcelCollection::of()->add(
                        Parcel::of()->setItems(
                            DeliveryItemCollection::of()->add(
                                DeliveryItem::of()
                                    ->setId($lineItem->getId())
                                    ->setQuantity(2)
                            )
                        )
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $lineItem = $order->getLineItems()->getAt(0);
        $lineItem2 = $order->getLineItems()->getAt(1);
        $customLineItem = $order->getCustomLineItems()->current();
        $parcel = $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderSetParcelItemsAction::ofParcel($parcel->getId())->setItems(
                    DeliveryItemCollection::of()->add(
                        DeliveryItem::of()
                            ->setId($lineItem->getId())
                            ->setQuantity(2)
                    )->add(
                        DeliveryItem::of()
                            ->setId($customLineItem->getId())
                            ->setQuantity(1)
                    )->add(
                        DeliveryItem::of()
                            ->setId($lineItem2->getId())
                            ->setQuantity(10)
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertCount(
            3,
            $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current()->getItems()
        );


        $request = ProductUpdateRequest::ofIdAndVersion($product2->getId(), $product2->getVersion())
            ->addAction(ProductUnpublishAction::of());
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $request = ProductDeleteRequest::ofIdAndVersion(
            $product2->getId(),
            $product2->getVersion()
        );
        $request->executeWithClient($this->getClient());
    }

    public function testSetParcelMeasurements()
    {
        $taxCategory = $this->getTaxCategory();
        $cartDraft = $this->getCartDraft();

        $product2 = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2')
        )
            ->setMasterVariant(
                ProductVariantDraft::of()->setSku('test-' . $this->getTestRun() . '-sku2')
                    ->setPrices(
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                ->setCountry('DE')
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
            ->setPublish(true)
        ;

        $request = ProductCreateRequest::ofDraft($product2);
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $cartDraft->getLineItems()->add(LineItemDraft::ofSku($product2->getMasterData()->getCurrent()->getMasterVariant()->getSku())->setQuantity(1));

        $cartDraft->setCustomLineItems(
            CustomLineItemDraftCollection::of()->add(
                CustomLineItemDraft::of()
                    ->setName(LocalizedString::ofLangAndText('en', 'test'))
                    ->setSlug('test')
                    ->setQuantity(1)
                    ->setMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    ->setTaxCategory($taxCategory->getReference())
            )
        );
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->getAt(0);
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddDeliveryAction::of()->setParcels(
                    ParcelCollection::of()->add(
                        Parcel::of()->setItems(
                            DeliveryItemCollection::of()->add(
                                DeliveryItem::of()
                                    ->setId($lineItem->getId())
                                    ->setQuantity(2)
                            )
                        )
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $parcel = $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderSetParcelMeasurementsAction::ofParcel($parcel->getId())->setMeasurements(
                    ParcelMeasurements::of()
                        ->setWeightInGram(10)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertSame(
            10,
            $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current()->getMeasurements()->getWeightInGram()
        );


        $request = ProductUpdateRequest::ofIdAndVersion($product2->getId(), $product2->getVersion())
            ->addAction(ProductUnpublishAction::of());
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $request = ProductDeleteRequest::ofIdAndVersion(
            $product2->getId(),
            $product2->getVersion()
        );
        $request->executeWithClient($this->getClient());
    }

    public function testSetTrackingData()
    {
        $taxCategory = $this->getTaxCategory();
        $cartDraft = $this->getCartDraft();

        $product2 = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2')
        )
            ->setMasterVariant(
                ProductVariantDraft::of()->setSku('test-' . $this->getTestRun() . '-sku2')
                    ->setPrices(
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                ->setCountry('DE')
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
            ->setPublish(true)
        ;

        $request = ProductCreateRequest::ofDraft($product2);
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $cartDraft->getLineItems()->add(LineItemDraft::ofSku($product2->getMasterData()->getCurrent()->getMasterVariant()->getSku())->setQuantity(1));

        $cartDraft->setCustomLineItems(
            CustomLineItemDraftCollection::of()->add(
                CustomLineItemDraft::of()
                    ->setName(LocalizedString::ofLangAndText('en', 'test'))
                    ->setSlug('test')
                    ->setQuantity(1)
                    ->setMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    ->setTaxCategory($taxCategory->getReference())
            )
        );
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->getAt(0);
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddDeliveryAction::of()->setParcels(
                    ParcelCollection::of()->add(
                        Parcel::of()->setItems(
                            DeliveryItemCollection::of()->add(
                                DeliveryItem::of()
                                    ->setId($lineItem->getId())
                                    ->setQuantity(2)
                            )
                        )
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $parcel = $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current();
        $trackingId = uniqid();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderSetParcelTrackingDataAction::ofParcel($parcel->getId())->setTrackingData(
                    TrackingData::of()->setTrackingId($trackingId)
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertSame(
            $trackingId,
            $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current()->getTrackingData()->getTrackingId()
        );


        $request = ProductUpdateRequest::ofIdAndVersion($product2->getId(), $product2->getVersion())
            ->addAction(ProductUnpublishAction::of());
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $request = ProductDeleteRequest::ofIdAndVersion(
            $product2->getId(),
            $product2->getVersion()
        );
        $request->executeWithClient($this->getClient());
    }

    public function testRemoveParcel()
    {
        $taxCategory = $this->getTaxCategory();
        $cartDraft = $this->getCartDraft();

        $product2 = ProductDraft::ofTypeNameAndSlug(
            $this->getProductType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product2')
        )
            ->setMasterVariant(
                ProductVariantDraft::of()->setSku('test-' . $this->getTestRun() . '-sku2')
                    ->setPrices(
                        PriceDraftCollection::of()->add(
                            PriceDraft::ofMoney(Money::ofCurrencyAndAmount('EUR', 100))
                                ->setCountry('DE')
                        )
                    )
            )
            ->setTaxCategory($this->getTaxCategory()->getReference())
            ->setPublish(true)
        ;

        $request = ProductCreateRequest::ofDraft($product2);
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $cartDraft->getLineItems()->add(LineItemDraft::ofSku($product2->getMasterData()->getCurrent()->getMasterVariant()->getSku())->setQuantity(1));

        $cartDraft->setCustomLineItems(
            CustomLineItemDraftCollection::of()->add(
                CustomLineItemDraft::of()
                    ->setName(LocalizedString::ofLangAndText('en', 'test'))
                    ->setSlug('test')
                    ->setQuantity(1)
                    ->setMoney(Money::ofCurrencyAndAmount('EUR', 100))
                    ->setTaxCategory($taxCategory->getReference())
            )
        );
        $order = $this->createOrder($cartDraft);

        $lineItem = $order->getLineItems()->getAt(0);
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderAddDeliveryAction::of()->setParcels(
                    ParcelCollection::of()->add(
                        Parcel::of()->setItems(
                            DeliveryItemCollection::of()->add(
                                DeliveryItem::of()
                                    ->setId($lineItem->getId())
                                    ->setQuantity(2)
                            )
                        )
                    )
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $parcel = $order->getShippingInfo()->getDeliveries()->current()->getParcels()->current();
        $request = OrderUpdateRequest::ofIdAndVersion($order->getId(), $order->getVersion())
            ->addAction(
                OrderRemoveParcelFromDeliveryAction::ofParcel($parcel->getId())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $order = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($order->getVersion());

        $this->assertCount(
            0,
            $order->getShippingInfo()->getDeliveries()->current()->getParcels()
        );


        $request = ProductUpdateRequest::ofIdAndVersion($product2->getId(), $product2->getVersion())
            ->addAction(ProductUnpublishAction::of());
        $response = $request->executeWithClient($this->getClient());
        $product2 = $request->mapResponse($response);

        $request = ProductDeleteRequest::ofIdAndVersion(
            $product2->getId(),
            $product2->getVersion()
        );
        $request->executeWithClient($this->getClient());
    }

    public function testCreateReplicaCartFromOrder()
    {
        $cartDraft = $this->getCartDraft();
        $order = $this->createOrder($cartDraft);

        $request = CartReplicateRequest::ofOrderId($order->getId());

        $response = $request->executeWithClient($this->getClient());
        $replicaCart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion($replicaCart->getId(), $replicaCart->getVersion());

        $this->assertNotEmpty($replicaCart->getLineItems());

        $orderLineItem = $order->getLineItems()->current()->getProductId();
        $replicaCartLineItem = $replicaCart->getLineItems()->current()->getProductId();

        $this->assertSame($orderLineItem, $replicaCartLineItem);
        $this->assertNotNull($replicaCartLineItem);
        $this->assertSame(CartState::ACTIVE, $replicaCart->getCartState());
    }

    public function testCreateOrderWithInitialData()
    {
        $cartDraft = $this->getCartDraft();
        list($state1, $state2) = $this->createStates('OrderState');
        $stateReference = $state1->getReference();
        $order = $this->createOrder($cartDraft, '123', 'Pending', 'Complete', $stateReference, 'Delayed');

        $this->assertSame('Pending', $order->getPaymentState());
        $this->assertSame('Complete', $order->getOrderState());
        $this->assertInstanceOf(StateReference::class, $order->getState());
        $this->assertSame($stateReference->getId(), $order->getState()->getId());
        $this->assertSame('Delayed', $order->getShipmentState());
    }
}
