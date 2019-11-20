<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Error\OutOfStockError;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\InventoryMode;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Model\Order\Delivery;
use Commercetools\Core\Model\Order\DeliveryCollection;
use Commercetools\Core\Model\Order\DeliveryItem;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Model\Order\ImportOrder;
use Commercetools\Core\Model\Order\LineItemImportDraft;
use Commercetools\Core\Model\Order\LineItemImportDraftCollection;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\Parcel;
use Commercetools\Core\Model\Order\ParcelCollection;
use Commercetools\Core\Model\Order\ProductVariantImportDraft;
use Commercetools\Core\Model\Order\ShippingInfoImportDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Request\Inventory\InventoryByIdGetRequest;
use Commercetools\Core\Request\Inventory\InventoryCreateRequest;
use Commercetools\Core\Request\Inventory\InventoryDeleteRequest;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderImportRequest;
use Commercetools\Core\Response\ErrorResponse;

class OrderImportRequestTest extends ApiTestCase
{

    /**
     * @return ImportOrder
     */
    protected function getOrderImportDraft()
    {
        $draft = ImportOrder::of();
        /**
         * @var Customer $customer
         */
        $customer = $this->getCustomer();
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
        $draft->setCustomerId($customer->getId())
            ->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setCountry('DE')
            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 100))
            ->setLineItems(
                LineItemImportDraftCollection::of()
                    ->add(
                        LineItemImportDraft::ofNamePriceVariantAndQuantity(
                            LocalizedString::ofLangAndText('en', 'test'),
                            Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100)),
                            ProductVariantImportDraft::ofSku($variant->getSku()),
                            1
                        )
                    )
            )
        ;

        return $draft;
    }

    public function getOriginTypes()
    {
        return [
            Cart::ORIGIN_CUSTOMER => [Cart::ORIGIN_CUSTOMER, true],
            Cart::ORIGIN_MERCHANT => [Cart::ORIGIN_MERCHANT, true],
            'invalidOrigin' => ['invalidOrigin', false],
        ];
    }

    /**
     * @return ImportOrder
     */
    protected function getOrderImportDraftOrigin()
    {
        $draft = ImportOrder::of();
        /**
         * @var Customer $customer
         */
        $customer = $this->getCustomer();
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();
        $draft->setCustomerId($customer->getId())
            ->setShippingAddress($customer->getDefaultShippingAddress())
            ->setBillingAddress($customer->getDefaultBillingAddress())
            ->setCustomerEmail($customer->getEmail())
            ->setCountry('DE')
            ->setTotalPrice(Money::ofCurrencyAndAmount('EUR', 100))
            ->setLineItems(
                LineItemImportDraftCollection::of()
                    ->add(
                        LineItemImportDraft::ofNamePriceVariantAndQuantity(
                            LocalizedString::ofLangAndText('en', 'test'),
                            Price::ofMoney(Money::ofCurrencyAndAmount('EUR', 100)),
                            ProductVariantImportDraft::ofSku($variant->getSku()),
                            1
                        )
                    )
            )
        ;

        return $draft;
    }

    protected function importOrder(ImportOrder $importOrder)
    {
        $orderRequest = OrderImportRequest::ofImportOrder($importOrder);
        $response = $orderRequest->executeWithClient($this->getClient());
        $order = $orderRequest->mapResponse($response);
        if ($order != null) {
            $this->cleanupRequests[] = $this->deleteRequest = OrderDeleteRequest::ofIdAndVersion(
                $order->getId(),
                $order->getVersion()
            );
        }

        return $order;
    }

    public function testImportOrder()
    {
        $importOrder = $this->getOrderImportDraft();
        $order = $this->importOrder($importOrder);

        $this->assertNotNull($order->getId());
        $this->assertNotNull($order->getVersion());
        $this->assertInstanceOf(Order::class, $order);
    }

    public function testImportOrderStore()
    {
        $importOrder = $this->getOrderImportDraft();
        $store = $this->getStore();
        $importOrder->setStore(StoreReference::ofKey($store->getKey()));
        $order = $this->importOrder($importOrder);

        $this->assertNotNull($order->getId());
        $this->assertNotNull($order->getVersion());
        $this->assertInstanceOf(Order::class, $order);
        $this->assertSame($store->getKey(), $order->getStore()->getKey());
    }

    /**
     * @dataProvider getOriginTypes()
     * @param $origin
     * @param $successful
     */
    public function testImportOrderOrigin($origin, $successful)
    {
        $importOrder = $this->getOrderImportDraft();
        $importOrder->setOrigin($origin);
        $order = $this->importOrder($importOrder);

        if ($successful) {
            $this->assertNotNull($order->getId());
            $this->assertNotNull($order->getVersion());
            $this->assertInstanceOf(Order::class, $order);
            $this->assertSame($origin, $order->getOrigin());
        } else {
            $this->assertNull($order);
        }
    }

    public function testWithStock()
    {
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $inventoryDraft = InventoryDraft::ofSkuAndQuantityOnStock($variant->getSku(), 1);
        $request = InventoryCreateRequest::ofDraft($inventoryDraft);
        $response = $request->executeWithClient($this->getClient());
        $inventory = $request->mapResponse($response);
        $this->cleanupRequests[] = $invDeleteRequest = InventoryDeleteRequest::ofIdAndVersion(
            $inventory->getId(),
            $inventory->getVersion()
        );
        $this->assertSame(1, $inventory->getQuantityOnStock());

        $importOrder = $this->getOrderImportDraft();
        $importOrder->setInventoryMode(InventoryMode::RESERVE_ON_ORDER);
        $order = $this->importOrder($importOrder);

        $this->assertNotNull($order->getId());
        $this->assertNotNull($order->getVersion());
        $this->assertInstanceOf(Order::class, $order);

        usleep(100000);

        $request = InventoryByIdGetRequest::ofId($inventory->getId());
        $response = $request->executeWithClient($this->getClient());
        $inventory = $request->mapResponse($response);
        $invDeleteRequest->setVersion($inventory->getVersion());

        $this->assertSame(0, $inventory->getQuantityOnStock());
    }

    public function testOutOfStock()
    {
        $product = $this->getProduct();
        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

        $inventoryDraft = InventoryDraft::ofSkuAndQuantityOnStock($variant->getSku(), 0);
        $request = InventoryCreateRequest::ofDraft($inventoryDraft);
        $response = $request->executeWithClient($this->getClient());
        $inventory = $request->mapResponse($response);
        $this->cleanupRequests[] = $invDeleteRequest = InventoryDeleteRequest::ofIdAndVersion(
            $inventory->getId(),
            $inventory->getVersion()
        );
        $this->assertSame(0, $inventory->getQuantityOnStock());

        $importOrder = $this->getOrderImportDraft();
        $importOrder->setInventoryMode(InventoryMode::RESERVE_ON_ORDER);

        $orderRequest = OrderImportRequest::ofImportOrder($importOrder);
        $response = $orderRequest->executeWithClient($this->getClient());

        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->assertInstanceOf(OutOfStockError::class, $response->getErrors()->getByCode('OutOfStock'));
        $this->assertSame(
            [$importOrder->getLineItems()->current()->getVariant()->getSku()],
            $response->getErrors()->getByCode('OutOfStock')->getSkus()
        );
    }

    public function testShippingInfo()
    {
        $draft = $this->getOrderImportDraft();
        $draft->setShippingInfo(
            ShippingInfoImportDraft::ofNamePriceRateAndState(
                'test-' . $this->getTestRun(),
                Money::ofCurrencyAndAmount('EUR', 100),
                ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 200)),
                ShippingInfoImportDraft::SHIPPING_METHOD_MATCH
            )
        );

        $order = $this->importOrder($draft);

        $this->assertNotNull($order->getId());
        $this->assertNotNull($order->getVersion());
        $this->assertInstanceOf(Order::class, $order);
        $this->assertInstanceOf(ShippingInfoImportDraft::class, $order->getShippingInfo());
        $this->assertSame('test-' . $this->getTestRun(), $order->getShippingInfo()->getShippingMethodName());
    }
}
