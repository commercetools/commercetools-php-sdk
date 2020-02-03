<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Customer;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;

class CustomerQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $request = RequestBuilder::of()->customers()->query()
                    ->where('email=:email', ['email' => $customer->getEmail()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Customer::class, $result->current());
                $this->assertSame($customer->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $request = RequestBuilder::of()->customers()->getById($customer->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $customer);
                $this->assertSame($customer->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) {
                return $draft->setKey('test-'. CustomerFixture::uniqueCustomerString());
            },
            function (Customer $customer) use ($client) {
                $request = RequestBuilder::of()->customers()->getByKey($customer->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $customer);
                $this->assertSame($customer->getId(), $result->getId());
            }
        );
    }

    public function testInStoreGetById()
    {
        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer, Store $store) use ($client) {
                $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                    $store->getKey(),
                    RequestBuilder::of()->customers()->getById($customer->getId())
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $customer);
                $this->assertSame($customer->getId(), $result->getId());
                $this->assertSame($customer->getStores()->current()->getId(), $result->getStores()->current()->getId());
            }
        );
    }

    public function testInStoreGetByKey()
    {
        $client = $this->getApiClient();

        CustomerFixture::withDraftCustomer(
            $client,
            function (CustomerDraft $draft) {
                return $draft->setKey('test-'. CustomerFixture::uniqueCustomerString());
            },
            function (Customer $customer, Store $store) use ($client) {
                $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                    $store->getKey(),
                    RequestBuilder::of()->customers()->getByKey($customer->getKey())
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $customer);
                $this->assertSame(
                    $customer->getStores()->current()->getKey(),
                    $result->getStores()->current()->getKey()
                );
            }
        );
    }

    public function testInStoreQueryCustomer()
    {
        $client = $this->getApiClient();

        CustomerFixture::withCustomer(
            $client,
            function (Customer $customer, Store $store) use ($client) {
                $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                    $store->getKey(),
                    RequestBuilder::of()->customers()->query()
                        ->where('email=:email', ['email' => $customer->getEmail()])
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Customer::class, $result->current());
                $this->assertSame($customer->getId(), $result->current()->getId());
            }
        );
    }
}
