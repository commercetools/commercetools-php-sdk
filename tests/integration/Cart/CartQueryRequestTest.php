<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Cart;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Cart\CartDraft;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingMethod;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodDraft;
use Commercetools\Core\Model\ShippingMethod\ShippingRate;
use Commercetools\Core\Model\ShippingMethod\ShippingRateCollection;
use Commercetools\Core\Model\ShippingMethod\ZoneRate;
use Commercetools\Core\Model\ShippingMethod\ZoneRateCollection;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Model\Zone\Location;
use Commercetools\Core\Model\Zone\LocationCollection;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\Carts\CartByCustomerIdGetRequest;
use Commercetools\Core\Request\Carts\CartQueryRequest;
use Commercetools\Core\Request\Carts\CartCreateRequest;
use Commercetools\Core\Request\Carts\CartDeleteRequest;
use Commercetools\Core\Request\Carts\CartByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodCreateRequest;
use Commercetools\Core\Request\ShippingMethods\ShippingMethodDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\Zones\ZoneCreateRequest;
use Commercetools\Core\Request\Zones\ZoneDeleteRequest;

class CartQueryRequestTest extends ApiTestCase
{
    /**
     * @var TaxCategory
     */
    private $taxCategory;

    /**
     * @var Zone
     */
    private $zone;

    /**
     * @var string
     */
    private $state;

    /**
     * @var ShippingMethod
     */
    private $shippingMethod;

    /**
     * @var Customer
     */
    private $customer;

    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteShippingMethod();
        $this->deleteTaxCategory();
        $this->deleteZone();
        $this->deleteCustomer();
    }

    private function getState()
    {
        if (is_null($this->state)) {
            $this->state = (string)mt_rand(1, 1000);
        }

        return $this->state;
    }

    private function getTaxCategory()
    {
        if (is_null($this->taxCategory)) {
            $taxCategoryDraft = TaxCategoryDraft::ofNameAndRates(
                'test-' . $this->getTestRun() . '-name',
                TaxRateCollection::of()->add(
                    TaxRate::of()->setName('test-' . $this->getTestRun() . '-name')
                        ->setAmount(0.2)
                        ->setIncludedInPrice(true)
                        ->setCountry('DE')
                        ->setState($this->getState())
                )
            );
            $request = TaxCategoryCreateRequest::ofDraft($taxCategoryDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }

        return $this->taxCategory;
    }

    private function deleteTaxCategory()
    {
        if (!is_null($this->taxCategory)) {
            $request = TaxCategoryDeleteRequest::ofIdAndVersion(
                $this->taxCategory->getId(),
                $this->taxCategory->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->taxCategory = $request->mapResponse($response);
        }
        $this->taxCategory = null;
    }

    private function getZone()
    {
        if (is_null($this->zone)) {
            $zoneDraft = ZoneDraft::ofNameAndLocations(
                'test-' . $this->getTestRun() . '-name',
                LocationCollection::of()->add(
                    Location::of()->setCountry('DE')->setState($this->getState())
                )
            );
            $request = ZoneCreateRequest::ofDraft($zoneDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->zone = $request->mapResponse($response);
        }

        return $this->zone;
    }

    private function deleteZone()
    {
        if (!is_null($this->zone)) {
            $request = ZoneDeleteRequest::ofIdAndVersion(
                $this->zone->getId(),
                $this->zone->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->zone = $request->mapResponse($response);
        }
        $this->zone = null;
    }

    /**
     * @return ShippingMethod
     */
    protected function getShippingMethod()
    {
        if (is_null($this->shippingMethod)) {
            $shippingMethodDraft = ShippingMethodDraft::ofNameTaxCategoryZoneRateAndDefault(
                'test-' . $this->getTestRun() . '-name',
                $this->getTaxCategory()->getReference(),
                ZoneRateCollection::of()->add(
                    ZoneRate::of()->setZone($this->getZone()->getReference())
                        ->setShippingRates(
                            ShippingRateCollection::of()->add(
                                ShippingRate::of()->setPrice(Money::ofCurrencyAndAmount('EUR', 100))
                            )
                        )
                ),
                false
            );

            $request = ShippingMethodCreateRequest::ofDraft($shippingMethodDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->shippingMethod = $request->mapResponse($response);
        }


        return $this->shippingMethod;
    }

    private function deleteShippingMethod()
    {
        if (!is_null($this->shippingMethod)) {
            $request = ShippingMethodDeleteRequest::ofIdAndVersion(
                $this->shippingMethod->getId(),
                $this->shippingMethod->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->shippingMethod = $request->mapResponse($response);
        }
        $this->shippingMethod = null;
    }

    private function getCustomer()
    {
        if (is_null($this->customer)) {
            $draft = CustomerDraft::ofEmailNameAndPassword(
                'test-' . $this->getTestRun() . '-email',
                'test-' . $this->getTestRun() . '-firstName',
                'test-' . $this->getTestRun() . '-lastName',
                'test-' . $this->getTestRun() . '-password'
            );
            $draft
                ->setAddresses(
                    AddressCollection::of()->add(
                        Address::of()
                            ->setCountry('DE')
                            ->setState($this->getState())
                    )
                )
                ->setDefaultBillingAddress(0)
                ->setDefaultShippingAddress(0)
            ;
            $request = CustomerCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $result = $request->mapResponse($response);
            $this->customer = $result->getCustomer();
        }

        return $this->customer;
    }

    private function deleteCustomer()
    {
        if (!is_null($this->customer)) {
            $request = CustomerDeleteRequest::ofIdAndVersion(
                $this->customer->getId(),
                $this->customer->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->customer = $request->mapResponse($response);
        }
        $this->customer = null;
    }

    /**
     * @return CartDraft
     */
    protected function getDraft()
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
//            ->setLineItems(
//                LineItemDraftCollection::of()
//                    ->add(
//                        LineItemDraft::of()
//                    )
//            )
            ->setShippingMethod($this->getShippingMethod()->getReference())
        ;

        return $draft;
    }

    protected function createCart(CartDraft $draft)
    {
        $request = CartCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $cart = $request->mapResponse($response);
        $this->cleanupRequests[] = CartDeleteRequest::ofIdAndVersion(
            $cart->getId(),
            $cart->getVersion()
        );

        return $cart;
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartByIdGetRequest::ofId($cart->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Cart\Cart', $result);
        $this->assertSame($cart->getId(), $result->getId());

    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartQueryRequest::of()->where(
            'customerEmail="' . $draft->getCustomerEmail() . '"'
        );

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Cart\Cart', $result->getAt(0));
        $this->assertSame($cart->getId(), $result->getAt(0)->getId());
    }

    public function testGetByCustomerId()
    {
        $draft = $this->getDraft();
        $cart = $this->createCart($draft);

        $request = CartByCustomerIdGetRequest::ofCustomerId($cart->getCustomerId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Cart\Cart', $result);
        $this->assertSame($cart->getId(), $result->getId());
    }
}
