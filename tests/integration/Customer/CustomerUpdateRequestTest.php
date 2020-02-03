<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Customer;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCompanyNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerGroupAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerNumberAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDateOfBirthAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetExternalIdAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetFirstNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetKeyAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLastNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLocaleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetMiddleNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetSalutationAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetTitleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use function GuzzleHttp\Psr7\str;

class CustomerUpdateRequestTest extends ApiTestCase
{
    /**
     * @return CustomerDraft
     */
    protected function getDraft($name)
    {
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'test-' . $this->getTestRun() . '-email',
            'test-' . $this->getTestRun() . '-' . $name,
            'test-' . $this->getTestRun() . '-lastName',
            'test-' . $this->getTestRun() . '-password'
        );

        return $draft;
    }

    protected function createCustomer(CustomerDraft $draft)
    {
        $request = CustomerCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = CustomerDeleteRequest::ofIdAndVersion(
            $result->getCustomer()->getId(),
            $result->getCustomer()->getVersion()
        );
        return $result->getCustomer();
    }

    protected function createStoreCustomer($storeKey, CustomerDraft $draft)
    {
        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
            $storeKey,
            CustomerCreateRequest::ofDraft($draft)
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->deleteRequest = CustomerDeleteRequest::ofIdAndVersion(
            $result->getCustomer()->getId(),
            $result->getCustomer()->getVersion()
        );
        $this->cleanupRequests[] = InStoreRequestDecorator::ofStoreKeyAndRequest($storeKey, $this->deleteRequest);

        return $result->getCustomer();
    }

    protected function getAddress()
    {
        return Address::of()
            ->setCountry('DE')
            ->setFirstName('new-' . CustomerFixture::uniqueCustomerString() . '-firstName');
    }

    public function testUpdateByKey()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableDraftCustomer(
            $client,
            function (CustomerDraft $draft) {
                return $draft->setKey('test-' . CustomerFixture::uniqueCustomerString());
            },
            function (Customer $customer) use ($client) {
                $firstName = 'test-' . CustomerFixture::uniqueCustomerString() . '-new firstName';

                $request = RequestBuilder::of()->customers()->updateByKey($customer)
                    ->addAction(
                        CustomerSetFirstNameAction::of()->setFirstName($firstName)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $result);
                $this->assertSame($firstName, $result->getFirstName());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $key = 'new-' . CustomerFixture::uniqueCustomerString();

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerSetKeyAction::of()->setKey($key)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $result);
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($customer->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testCustomerEmail()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $email = 'new-' . CustomerFixture::uniqueCustomerString() . '@example.com';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerChangeEmailAction::ofEmail($email));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($email, $result->getEmail());

                return $result;
            }
        );
    }

    public function testSalutation()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $salutation = 'new-salutation';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetSalutationAction::of()->setSalutation($salutation));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($salutation, $result->getSalutation());

                return $result;
            }
        );
    }

    public function testNoopCustomerEmail()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $version = $customer->getVersion();

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerChangeEmailAction::ofEmail($customer->getEmail()));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($version, $result->getVersion());
                $this->assertSame($customer->getEmail(), $result->getEmail());

                return $result;
            }
        );
    }

    public function testFirstName()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $firstName = 'new-' . CustomerFixture::uniqueCustomerString() . '-firstName';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetFirstNameAction::of()->setFirstName($firstName))
                    ->addAction(CustomerSetFirstNameAction::of()->setFirstName($firstName));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($firstName, $result->getFirstName());

                return $result;
            }
        );
    }

    public function testLastName()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $lastName = 'new-' . CustomerFixture::uniqueCustomerString() . '-lastName';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetLastNameAction::of()->setLastName($lastName));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($lastName, $result->getLastName());

                return $result;
            }
        );
    }

    public function testMiddleName()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $middleName = 'new-' . CustomerFixture::uniqueCustomerString() . '-middleName';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetMiddleNameAction::of()->setMiddleName($middleName));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($middleName, $result->getMiddleName());

                return $result;
            }
        );
    }

    public function testTitle()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $title = 'new-' . CustomerFixture::uniqueCustomerString() . '-title';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetTitleAction::of()->setTitle($title));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($title, $result->getTitle());

                return $result;
            }
        );
    }

    public function testAddress()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $address = $this->getAddress();

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerAddAddressAction::ofAddress($address));
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getAddresses());
                $this->assertSame($address->getFirstName(), $customer->getAddresses()->current()->getFirstName());

                $address = Address::of()
                    ->setCountry('DE')
                    ->setLastName('new-' . CustomerFixture::uniqueCustomerString() . '-lastName');

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerChangeAddressAction::ofAddressIdAndAddress(
                            $customer->getAddresses()->current()->getId(),
                            $address
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertNull($customer->getAddresses()->current()->getFirstName());
                $this->assertSame($address->getLastName(), $customer->getAddresses()->current()->getLastName());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerRemoveAddressAction::ofAddressId($customer->getAddresses()->current()->getId()))
                ;
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result->getAddresses());

                return $result;
            }
        );
    }

    public function testAddressExternalId()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $externalId = uniqid();
                $address = $this->getAddress()->setExternalId($externalId);

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerAddAddressAction::ofAddress($address));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result->getAddresses());
                $this->assertSame($externalId, $result->getAddresses()->current()->getExternalId());

                return $result;
            }
        );
    }

    public function testDefaultShippingAddress()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $address = $this->getAddress();

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerAddAddressAction::ofAddress($address));
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getAddresses());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerSetDefaultShippingAddressAction::of()->setAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($address->getFirstName(), $result->getDefaultShippingAddress()->getFirstName());

                return $result;
            }
        );
    }

    public function testShippingBillingAddressCreate()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableDraftCustomer(
            $client,
            function (CustomerDraft $draft) {
                $draft->setAddresses(AddressCollection::of()->add(Address::of()->setCountry('DE')))
                    ->setShippingAddresses([0])->setBillingAddresses([0]);

                return $draft;
            },
            function (Customer $customer) use ($client) {
                $this->assertArrayHasKey(0, $customer->getShippingAddressIds());
                $this->assertArrayHasKey(0, $customer->getBillingAddressIds());

                return $customer;
            }
        );
    }

    public function testAddShippingAddress()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $address = $this->getAddress();

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerAddAddressAction::ofAddress($address));
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getAddresses());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerAddShippingAddressAction::of()->setAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertSame(
                    $address->getFirstName(),
                    $customer->getAddresses()->getById(current($customer->getShippingAddressIds()))->getFirstName()
                );

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveShippingAddressAction::of()->setAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEmpty($result->getShippingAddressIds());

                return $result;
            }
        );
    }

    public function testAddBillingAddress()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $address = $this->getAddress();

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerAddAddressAction::ofAddress($address));
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getAddresses());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerAddShippingAddressAction::of()->setAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertSame(
                    $address->getFirstName(),
                    $customer->getAddresses()->getById(current($customer->getShippingAddressIds()))->getFirstName()
                );

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveShippingAddressAction::of()->setAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEmpty($result->getShippingAddressIds());

                return $result;
            }
        );


        $draft = $this->getDraft('title');
        $customer = $this->createCustomer($draft);

        $address = Address::of()
            ->setCountry('DE')
            ->setFirstName('new-' . $this->getTestRun() . '-firstName');

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerAddAddressAction::ofAddress($address))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertCount(1, $customer->getAddresses());

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                CustomerAddBillingAddressAction::of()->setAddressId(
                    $customer->getAddresses()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame(
            $address->getFirstName(),
            $customer->getAddresses()->getById(current($customer->getBillingAddressIds()))->getFirstName()
        );

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                CustomerRemoveBillingAddressAction::of()->setAddressId(
                    $customer->getAddresses()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertEmpty($customer->getBillingAddressIds());
    }

    public function testDefaultBillingAddress()
    {
        $draft = $this->getDraft('title');
        $customer = $this->createCustomer($draft);

        $address = Address::of()
            ->setCountry('DE')
            ->setFirstName('new-' . $this->getTestRun() . '-firstName');

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerAddAddressAction::ofAddress($address))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertCount(1, $customer->getAddresses());

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                CustomerSetDefaultBillingAddressAction::of()->setAddressId(
                    $customer->getAddresses()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($address->getFirstName(), $customer->getDefaultBillingAddress()->getFirstName());
    }

    public function testCustomerGroup()
    {
        $draft = $this->getDraft('customer-group');
        $customer = $this->createCustomer($draft);

        $customerGroup = $this->getCustomerGroup();

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetCustomerGroupAction::of()->setCustomerGroup($customerGroup->getReference()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($customerGroup->getId(), $customer->getCustomerGroup()->getId());
    }

    public function testCustomerNumber()
    {
        $draft = $this->getDraft('customer-number');
        $customer = $this->createCustomer($draft);

        $customerNumber = 'new-' . $this->getTestRun() . '-customerNumber';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetCustomerNumberAction::of()->setCustomerNumber($customerNumber))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($customerNumber, $customer->getCustomerNumber());
    }

    public function testExternalId()
    {
        $draft = $this->getDraft('external-id');
        $customer = $this->createCustomer($draft);

        $externalId = 'new-' . $this->getTestRun() . '-externalId';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetExternalIdAction::of()->setExternalId($externalId))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($externalId, $customer->getExternalId());
    }

    public function testCompanyName()
    {
        $draft = $this->getDraft('company-name');
        $customer = $this->createCustomer($draft);

        $companyName = 'new-' . $this->getTestRun() . '-companyName';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetCompanyNameAction::of()->setCompanyName($companyName))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($companyName, $customer->getCompanyName());

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetCompanyNameAction::of()->setCompanyName($companyName))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertSame($customer->getVersion(), $result->getVersion());
        $this->assertSame($customer->getCompanyName(), $result->getCompanyName());
    }

    public function testDateOfBirth()
    {
        $draft = $this->getDraft('date-of-birth');
        $draft->setDateOfBirth(new \DateTime('yesterday'));
        $customer = $this->createCustomer($draft);

        $timezone = date_default_timezone_get();
        date_default_timezone_set('CET');
        $dateOfBirth = new \DateTime('today');

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetDateOfBirthAction::of()->setDateOfBirth($dateOfBirth))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertEquals($dateOfBirth, $customer->getDateOfBirth()->getDateTime());
        date_default_timezone_set($timezone);
    }

    public function testVatId()
    {
        $draft = $this->getDraft('vat-id');
        $customer = $this->createCustomer($draft);

        $vatId = 'new-' . $this->getTestRun() . '-vatId';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetVatIdAction::of()->setVatId($vatId))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertEquals($vatId, $customer->getVatId());
    }

    public function testCustomType()
    {
        $draft = $this->getDraft('custom-type');
        $customer = $this->createCustomer($draft);

        $type = $this->getType('key-' . $this->getTestRun(), 'customer');

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                SetCustomTypeAction::ofTypeKey($type->getKey())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($type->getId(), $customer->getCustom()->getType()->getId());
    }

    public function testCustomField()
    {
        $typeKey = 'key-' . $this->getTestRun();

        // create custom type for customer resource
        $type = $this->getType($typeKey, 'customer');

        $draft = $this->getDraft('custom-field');
        // add custom type field at customer creation
        $draft->setCustom(
            CustomFieldObjectDraft::ofTypeKeyAndFields($typeKey, FieldContainer::of()->setTestField('value'))
        );
        $customer = $this->createCustomer($draft);

        $this->assertSame('value', $customer->getCustom()->getFields()->getTestField());

        // set custom type and field at customer update
        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                SetCustomTypeAction::ofTypeKey($typeKey)
                    ->setFields(
                        FieldContainer::of()
                            ->setTestField('new value')
                    )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame('new value', $customer->getCustom()->getFields()->getTestField());

        // set custom field only if custom type is already set
        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                SetCustomFieldAction::ofName('testField')
                    ->setValue($this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($this->getTestRun(), $customer->getCustom()->getFields()->getTestField());
    }


    public function testSetExternalUserOnCustomerUpdate()
    {
        $draft = $this->getDraft('name');

        $request = CustomerCreateRequest::ofDraft($draft);
        $request->setExternalUserId('custom-external-user-id');

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = CustomerDeleteRequest::ofIdAndVersion(
            $result->getCustomer()->getId(),
            $result->getCustomer()->getVersion()
        );
        $customer = $result->getCustomer();

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertInstanceOf(CreatedBy::class, $customer->getCreatedBy());
        $this->assertInstanceOf(LastModifiedBy::class, $customer->getLastModifiedBy());
        $this->assertSame('custom-external-user-id', $customer->getCreatedBy()->getExternalUserId());
        $this->assertSame('custom-external-user-id', $customer->getLastModifiedBy()->getExternalUserId());

        $key = 'new-' . $this->getTestRun();
        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                CustomerSetKeyAction::of()->setKey($key)
            )
        ;
        $request->setExternalUserId('another-user');

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Customer::class, $result);
        $this->assertInstanceOf(CreatedBy::class, $result->getCreatedBy());
        $this->assertInstanceOf(LastModifiedBy::class, $result->getLastModifiedBy());
        $this->assertSame('custom-external-user-id', $result->getCreatedBy()->getExternalUserId());
        $this->assertSame('another-user', $result->getLastModifiedBy()->getExternalUserId());
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
        $draft = $this->getCustomerDraft();
        $customer = $this->createCustomer($draft);

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetLocaleAction::ofLocale($locale))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);

        $this->deleteRequest->setVersion($customer->getVersion());

        $this->assertSame($expectedLocale, $customer->getLocale());
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
        $draft = $this->getCustomerDraft();
        $customer = $this->createCustomer($draft);

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetLocaleAction::ofLocale($locale))
        ;
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
    }

    public function testUpdateInStoreCustomerById()
    {
        $store = $this->getStore();
        $draft = $this->getDraft('in-store-update-by-id');
        $customer = $this->createStoreCustomer($store->getKey(), $draft);

        $firstName = 'test-' . $this->getTestRun() . '-new firstName';
        $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
            $store->getKey(),
            CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                CustomerSetFirstNameAction::of()->setFirstName($firstName)
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Customer::class, $result);
        $this->assertSame($firstName, $result->getFirstName());
    }

    public function testUpdateInStoreCustomerByKey()
    {
        $store = $this->getStore();
        $draft = $this->getDraft('in-store-update-by-key');
        $draft->setKey('test-'. $this->getTestRun());
        $customer = $this->createStoreCustomer($store->getKey(), $draft);

        $firstName = 'test-' . $this->getTestRun() . '-new firstName';
        $request =InStoreRequestDecorator::ofStoreKeyAndRequest(
            $store->getKey(),
            CustomerUpdateByKeyRequest::ofKeyAndVersion($customer->getKey(), $customer->getVersion())
            ->addAction(
                CustomerSetFirstNameAction::of()->setFirstName($firstName)
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapFromResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Customer::class, $result);
        $this->assertSame($firstName, $result->getFirstName());
    }
}
