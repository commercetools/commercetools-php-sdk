<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Order;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\Customer\CustomerFixture;
use Commercetools\Core\IntegrationTests\Inventory\InventoryFixture;
use Commercetools\Core\IntegrationTests\Product\ProductFixture;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Model\Cart\InventoryMode;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Inventory\InventoryDraft;
use Commercetools\Core\Model\Inventory\InventoryEntry;
use Commercetools\Core\Model\Order\ImportOrder;
use Commercetools\Core\Model\Order\LineItemImportDraft;
use Commercetools\Core\Model\Order\LineItemImportDraftCollection;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Model\Order\ProductVariantImportDraft;
use Commercetools\Core\Model\Order\ShippingInfoImportDraft;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Request\Orders\OrderDeleteRequest;
use Commercetools\Core\Request\Orders\OrderImportRequest;

class OrderImportRequestTest extends ApiTestCase
{
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

    public function testImportOrder()
    {
        $client = $this->getApiClient();

        OrderImportFixture::withOrderImport(
            $client,
            function (Order $order) use ($client) {
                $this->assertInstanceOf(Order::class, $order);
                $this->assertNotNull($order->getId());
                $this->assertNotNull($order->getVersion());

                return $order;
            }
        );
    }

    public function testImportOrderStore()
    {
        $client = $this->getApiClient();

        OrderImportFixture::withStoreOrderImport(
            $client,
            function (Order $order, Customer $customer, Product $product, Store $store) use ($client) {
                $this->assertNotNull($order->getId());
                $this->assertNotNull($order->getVersion());
                $this->assertInstanceOf(Order::class, $order);
                $this->assertSame($store->getKey(), $order->getStore()->getKey());

                return $order;
            }
        );
    }

    public function getValidOriginTypes()
    {
        return [
            Cart::ORIGIN_CUSTOMER => [Cart::ORIGIN_CUSTOMER, true],
            Cart::ORIGIN_MERCHANT => [Cart::ORIGIN_MERCHANT, true]
        ];
    }

    /**
     * @dataProvider getValidOriginTypes()
     * @param $origin
     */
    public function testImportOrderValidOrigin($origin)
    {
        $client = $this->getApiClient();

        OrderImportFixture::withDraftOrderImport(
            $client,
            function (ImportOrder $importOrder) use ($origin) {
                return $importOrder->setOrigin($origin);
            },
            function (Order $order) use ($client, $origin) {
                $this->assertNotNull($order->getId());
                $this->assertNotNull($order->getVersion());
                $this->assertInstanceOf(Order::class, $order);
                $this->assertSame($origin, $order->getOrigin());

                return $order;
            }
        );
    }

    public function getInvalidOriginTypes()
    {
        return [
            'invalidOrigin' => ['invalidOrigin', false]
        ];
    }

    /**
     * @dataProvider getInvalidOriginTypes()
     * @param $origin
     */
    public function testImportOrderInvalidOrigin($origin)
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $client = $this->getApiClient();

        OrderImportFixture::withDraftOrderImport(
            $client,
            function (ImportOrder $importOrder) use ($origin) {
                return $importOrder->setOrigin($origin);
            },
            function (Order $order) use ($client, $origin) {
                $this->assertNull($order);

                return $order;
            }
        );
    }

    public function testWithStock()
    {
        $client = $this->getApiClient();

        OrderImportFixture::withDraftOrderImportWithInventory(
            $client,
            function (ImportOrder $importOrder) {
                return $importOrder->setInventoryMode(InventoryMode::RESERVE_ON_ORDER);
            },
            function (Order $order, Customer $customer, Product $product, InventoryEntry $inventory) use ($client) {
                $this->assertNotNull($order->getId());
                $this->assertNotNull($order->getVersion());
                $this->assertInstanceOf(Order::class, $order);
                $this->assertSame(1, $inventory->getQuantityOnStock());

                usleep(100000);

                $request = RequestBuilder::of()->inventory()->getById($inventory->getId());
                $response = $this->execute($client, $request);
                $inventory = $request->mapFromResponse($response);

                $request = RequestBuilder::of()->inventory()->delete($inventory);
                $response = $this->execute($client, $request);
                $inventory = $request->mapFromResponse($response);

                $this->assertSame(0, $inventory->getQuantityOnStock());

                return $order;
            }
        );
    }

    public function testOutOfStock()
    {
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage('OutOfStock');

        $client = $this->getApiClient();

        ProductFixture::withPublishedProduct(
            $client,
            function (Product $product, ProductType $productType, TaxCategory $taxCategory) use ($client) {
                InventoryFixture::withDraftInventory(
                    $client,
                    function (InventoryDraft $inventoryDraft) use ($product) {
                        $variant = $product->getMasterData()->getCurrent()->getMasterVariant();

                        return $inventoryDraft->setSku($variant->getSku())->setQuantityOnStock(0);
                    },
                    function (InventoryEntry $inventory) use ($client, $taxCategory, $product) {
                        CustomerFixture::withDraftCustomer(
                            $client,
                            function (CustomerDraft $customerDraft) use ($taxCategory) {
                                $state = $taxCategory->getRates()->current()->getState();
                                $customerDraft
                                    ->setAddresses(
                                        AddressCollection::of()->add(
                                            Address::of()
                                                ->setCountry('DE')
                                                ->setState($state)
                                        )
                                    )
                                    ->setDefaultBillingAddress(0)
                                    ->setDefaultShippingAddress(0);

                                return $customerDraft;
                            },
                            function (Customer $customer) use ($client, $product, $inventory) {
                                OrderImportFixture::withDraftOrderImport(
                                    $client,
                                    function (ImportOrder $importOrder) {
                                        return $importOrder->setInventoryMode(InventoryMode::RESERVE_ON_ORDER);
                                    },
                                    function (Order $order) use ($client, $product, $inventory) {
                                    }
                                );
                            }
                        );
                    }
                );
            }
        );
    }

    public function testShippingInfo()
    {
        $client = $this->getApiClient();
        $shippingMethodName = 'test-' . OrderImportFixture::uniqueOrderImportString();

        OrderImportFixture::withDraftOrderImport(
            $client,
            function (ImportOrder $importOrder) use ($shippingMethodName) {
                return $importOrder->setShippingInfo(
                    ShippingInfoImportDraft::ofNamePriceRateAndState(
                        $shippingMethodName,
                        Money::ofCurrencyAndAmount('EUR', 100),
                        ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 200)),
                        ShippingInfoImportDraft::SHIPPING_METHOD_MATCH
                    )
                );
            },
            function (Order $order) use ($client, $shippingMethodName) {
                $this->assertNotNull($order->getId());
                $this->assertNotNull($order->getVersion());
                $this->assertInstanceOf(Order::class, $order);
                $this->assertInstanceOf(ShippingInfoImportDraft::class, $order->getShippingInfo());
                $this->assertSame($shippingMethodName, $order->getShippingInfo()->getShippingMethodName());

                return $order;
            }
        );
    }
}
