<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Customer;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\CustomerGroup\CustomerGroupFixture;
use Commercetools\Core\IntegrationTests\Store\StoreFixture;
use Commercetools\Core\IntegrationTests\Type\TypeFixture;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Store\Store;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\Store\StoreReferenceCollection;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerAddStoreAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveStoreAction;
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
use Commercetools\Core\Request\Customers\Command\CustomerSetStoresAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetTitleAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;

class CustomerUpdateRequestTest extends ApiTestCase
{
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
                        CustomerSetDefaultShippingAddressAction::ofAddressId(
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
                        CustomerAddShippingAddressAction::ofAddressId(
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
                        CustomerRemoveShippingAddressAction::ofAddressId(
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
                        CustomerAddBillingAddressAction::ofAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertSame(
                    $address->getFirstName(),
                    $customer->getAddresses()->getById(current($customer->getBillingAddressIds()))->getFirstName()
                );

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveBillingAddressAction::ofAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEmpty($result->getBillingAddressIds());

                return $result;
            }
        );
    }

    public function testDefaultBillingAddress()
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
                        CustomerSetDefaultBillingAddressAction::ofAddressId(
                            $customer->getAddresses()->current()->getId()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($address->getFirstName(), $result->getDefaultBillingAddress()->getFirstName());

                return $result;
            }
        );
    }

    public function testCustomerGroup()
    {
        $client = $this->getApiClient();

        CustomerGroupFixture::withCustomerGroup(
            $client,
            function (CustomerGroup $customerGroup) use ($client) {
                CustomerFixture::withUpdateableCustomer(
                    $client,
                    function (Customer $customer) use ($client, $customerGroup) {
                        $request = RequestBuilder::of()->customers()->update($customer)
                            ->addAction(
                                CustomerSetCustomerGroupAction::of()->setCustomerGroup($customerGroup->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($customerGroup->getId(), $result->getCustomerGroup()->getId());

                        return $result;
                    }
                );
            }
        );
    }

    public function testCustomerNumber()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $customerNumber = 'new-' . CustomerFixture::uniqueCustomerString() . '-customerNumber';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetCustomerNumberAction::of()->setCustomerNumber($customerNumber));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customerNumber, $result->getCustomerNumber());

                return $result;
            }
        );
    }

    public function testExternalId()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $externalId = 'new-' . CustomerFixture::uniqueCustomerString() . '-externalId';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetExternalIdAction::of()->setExternalId($externalId));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($externalId, $result->getExternalId());

                return $result;
            }
        );
    }

    public function testCompanyName()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $companyName = 'new-' . CustomerFixture::uniqueCustomerString() . '-companyName';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetCompanyNameAction::of()->setCompanyName($companyName));
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertSame($companyName, $customer->getCompanyName());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetCompanyNameAction::of()->setCompanyName($companyName));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($customer->getVersion(), $result->getVersion());
                $this->assertSame($customer->getCompanyName(), $result->getCompanyName());

                return $result;
            }
        );
    }

    public function testDateOfBirth()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableDraftCustomer(
            $client,
            function (CustomerDraft $draft) {
                return $draft->setDateOfBirth(new \DateTime('yesterday'));
            },
            function (Customer $customer) use ($client) {
                $timezone = date_default_timezone_get();
                date_default_timezone_set('CET');
                $dateOfBirth = new \DateTime('today');

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetDateOfBirthAction::of()->setDateOfBirth($dateOfBirth));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEquals($dateOfBirth, $result->getDateOfBirth()->getDateTime());
                date_default_timezone_set($timezone);

                return $result;
            }
        );
    }

    public function testVatId()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $vatId = 'new-' . CustomerFixture::uniqueCustomerString() . '-vatId';

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetVatIdAction::of()->setVatId($vatId));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEquals($vatId, $result->getVatId());

                return $result;
            }
        );
    }

    public function testCustomType()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('key-' . TypeFixture::uniqueTypeString())->setResourceTypeIds(['customer']);
            },
            function (Type $type) use ($client) {
                CustomerFixture::withUpdateableCustomer(
                    $client,
                    function (Customer $customer) use ($client, $type) {
                        $request = RequestBuilder::of()->customers()->update($customer)
                            ->addAction(SetCustomTypeAction::ofTypeKey($type->getKey()));
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());

                        return $result;
                    }
                );
            }
        );
    }

    public function testCustomField()
    {
        $client = $this->getApiClient();
        $typeKey = 'key-' . TypeFixture::uniqueTypeString();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) use ($typeKey) {
                return $typeDraft->setKey($typeKey)->setResourceTypeIds(['customer']);
            },
            function (Type $type) use ($client, $typeKey) {
                CustomerFixture::withUpdateableDraftCustomer(
                    $client,
                    function (CustomerDraft $customerDraft) use ($typeKey) {
                        return $customerDraft->setCustom(
                            CustomFieldObjectDraft::ofTypeKeyAndFields(
                                $typeKey,
                                FieldContainer::of()->setTestField('value')
                            )
                        );
                    },
                    function (Customer $customer) use ($client, $type, $typeKey) {
                        $this->assertSame('value', $customer->getCustom()->getFields()->getTestField());

                        $request = RequestBuilder::of()->customers()->update($customer)
                            ->addAction(
                                SetCustomTypeAction::ofTypeKey($typeKey)
                                    ->setFields(
                                        FieldContainer::of()
                                            ->setTestField('new value')
                                    )
                            );
                        $response = $this->execute($client, $request);
                        $customer = $request->mapFromResponse($response);

                        $this->assertSame('new value', $customer->getCustom()->getFields()->getTestField());

                        $request = RequestBuilder::of()->customers()->update($customer)
                            ->addAction(
                                SetCustomFieldAction::ofName('testField')
                                    ->setValue($this->getTestRun())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertSame($this->getTestRun(), $result->getCustom()->getFields()->getTestField());

                        return $result;
                    }
                );
            }
        );
    }

    public function testSetExternalUserOnCustomerUpdate()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $this->assertInstanceOf(Customer::class, $customer);
                $this->assertInstanceOf(CreatedBy::class, $customer->getCreatedBy());
                $this->assertInstanceOf(LastModifiedBy::class, $customer->getLastModifiedBy());
                $this->assertSame('custom-external-user-id', $customer->getCreatedBy()->getExternalUserId());
                $this->assertSame('custom-external-user-id', $customer->getLastModifiedBy()->getExternalUserId());

                $key = 'new-' . CustomerFixture::uniqueCustomerString();

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerSetKeyAction::of()->setKey($key)
                    );

                $headers[CustomerFixture::EXTERNAL_USER_HEADER] = ['another-user'];
                $response = $this->execute($client, $request, $headers);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $result);
                $this->assertInstanceOf(CreatedBy::class, $result->getCreatedBy());
                $this->assertInstanceOf(LastModifiedBy::class, $result->getLastModifiedBy());
                $this->assertSame('custom-external-user-id', $result->getCreatedBy()->getExternalUserId());
                $this->assertSame('another-user', $result->getLastModifiedBy()->getExternalUserId());

                return $result;
            }
        );
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
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client, $locale, $expectedLocale) {
                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetLocaleAction::ofLocale($locale));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($expectedLocale, $result->getLocale());

                return $result;
            }
        );
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
        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessageRegExp("/InvalidInput/");

        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client, $locale) {
                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerSetLocaleAction::ofLocale($locale));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                return $result;
            }
        );
    }

    public function testUpdateInStoreCustomerById()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableStoreCustomer(
            $client,
            function (Customer $customer, Store $store) use ($client) {
                $firstName = 'test-' . $this->getTestRun() . '-new firstName';

                $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                    $store->getKey(),
                    RequestBuilder::of()->customers()->update($customer)
                        ->addAction(
                            CustomerSetFirstNameAction::of()->setFirstName($firstName)
                        )
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $result);
                $this->assertSame($firstName, $result->getFirstName());

                return $result;
            }
        );
    }

    public function testUpdateInStoreCustomerByKey()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableDraftStoreCustomer(
            $client,
            function (CustomerDraft $customerDraft) {
                return $customerDraft->setKey('test-'. CustomerFixture::uniqueCustomerString());
            },
            function (Customer $customer, Store $store) use ($client) {
                $firstName = 'test-' . CustomerFixture::uniqueCustomerString() . '-new firstName';

                $request = InStoreRequestDecorator::ofStoreKeyAndRequest(
                    $store->getKey(),
                    RequestBuilder::of()->customers()->update($customer)
                        ->addAction(
                            CustomerSetFirstNameAction::of()->setFirstName($firstName)
                        )
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Customer::class, $result);
                $this->assertSame($firstName, $result->getFirstName());

                return $result;
            }
        );
    }

    public function testSetStores()
    {
        $client = $this->getApiClient();

        StoreFixture::withStore(
            $client,
            function (Store $store) use ($client) {
                CustomerFixture::withUpdateableStoreCustomer(
                    $client,
                    function (Customer $customer) use ($client, $store) {
                        $storeReference = StoreReferenceCollection::of()->add($store->getReference());

                        $request = RequestBuilder::of()->customers()->update($customer)
                            ->addAction(
                                CustomerSetStoresAction::ofStores($storeReference)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Customer::class, $result);
                        $this->assertSame($store->getKey(), $result->getStores()->current()->getKey());
                        $this->assertNotSame($customer->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testAddStore()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableStoreCustomer(
            $client,
            function (Customer $customer, Store $store) use ($client) {
                $storeReference = StoreReference::ofKey($store->getKey());

                $request = RequestBuilder::of()->customers()->update($customer)
                        ->addAction(CustomerAddStoreAction::ofStore($storeReference));
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getStores());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveStoreAction::of()->setStore($storeReference)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEmpty($result->getStores());

                return $result;
            }
        );
    }

    public function testAddressWithKey()
    {
        $client = $this->getApiClient();

        CustomerFixture::withUpdateableCustomer(
            $client,
            function (Customer $customer) use ($client) {
                $address = $this->getAddress()->setKey('key-' . CustomerFixture::uniqueCustomerString());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(CustomerAddAddressAction::ofAddress($address));
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getAddresses());
                $this->assertSame($address->getFirstName(), $customer->getAddresses()->current()->getFirstName());

                $address = Address::of()
                    ->setKey('new-key-' . CustomerFixture::uniqueCustomerString())
                    ->setCountry('DE')
                    ->setLastName('new-' . CustomerFixture::uniqueCustomerString() . '-lastName');

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerChangeAddressAction::ofAddressKeyAndAddress(
                            $customer->getAddresses()->current()->getKey(),
                            $address
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertNull($customer->getAddresses()->current()->getFirstName());
                $this->assertSame($address->getLastName(), $customer->getAddresses()->current()->getLastName());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveAddressAction::ofAddressKey(
                            $customer->getAddresses()->current()->getKey()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result->getAddresses());

                return $result;
            }
        );
    }

    public function testAddressUpdateWithNewKey()
    {
        $client = $this->getApiClient();
        $address = Address::of()
            ->setCountry('DE')
            ->setKey('key-' . CustomerFixture::uniqueCustomerString());

        CustomerFixture::withUpdateableDraftCustomer(
            $client,
            function (CustomerDraft $customerDraft) use ($address) {
                return $customerDraft->setAddresses(AddressCollection::of()->add($address));
            },
            function (Customer $customer) use ($client, $address) {
                $this->assertCount(1, $customer->getAddresses());

                $newAddress = Address::of()
                    ->setKey('new-key-' . CustomerFixture::uniqueCustomerString())
                    ->setCountry('DE')
                    ->setLastName('new-' . CustomerFixture::uniqueCustomerString() . '-lastName');

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerChangeAddressAction::ofAddressKeyAndAddress(
                            $customer->getAddresses()->current()->getKey(),
                            $newAddress
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertSame($newAddress->getKey(), $customer->getAddresses()->current()->getKey());
                $this->assertCount(1, $customer->getAddresses());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveAddressAction::ofAddressKey(
                            $customer->getAddresses()->current()->getKey()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result->getAddresses());

                return $result;
            }
        );
    }

    public function testAddBillingAddressWithKey()
    {
        $client = $this->getApiClient();
        $address = Address::of()
            ->setCountry('DE')
            ->setKey('key-' . CustomerFixture::uniqueCustomerString());

        CustomerFixture::withUpdateableDraftCustomer(
            $client,
            function (CustomerDraft $customerDraft) use ($address) {
                return $customerDraft->setAddresses(AddressCollection::of()->add($address));
            },
            function (Customer $customer) use ($client, $address) {
                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerAddBillingAddressAction::ofAddressKey(
                            $customer->getAddresses()->current()->getKey()
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getAddresses());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveBillingAddressAction::ofAddressKey(
                            $customer->getAddresses()->current()->getKey()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEmpty($result->getBillingAddressIds());

                return $result;
            }
        );
    }

    public function testAddShippingAddressWithKey()
    {
        $client = $this->getApiClient();
        $address = Address::of()
            ->setCountry('DE')
            ->setKey('key-' . CustomerFixture::uniqueCustomerString());

        CustomerFixture::withUpdateableDraftCustomer(
            $client,
            function (CustomerDraft $customerDraft) use ($address) {
                return $customerDraft->setAddresses(AddressCollection::of()->add($address));
            },
            function (Customer $customer) use ($client, $address) {
                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerAddShippingAddressAction::ofAddressKey(
                            $customer->getAddresses()->current()->getKey()
                        )
                    );
                $response = $this->execute($client, $request);
                $customer = $request->mapFromResponse($response);

                $this->assertCount(1, $customer->getAddresses());

                $request = RequestBuilder::of()->customers()->update($customer)
                    ->addAction(
                        CustomerRemoveShippingAddressAction::ofAddressKey(
                            $customer->getAddresses()->current()->getKey()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertEmpty($result->getShippingAddressIds());

                return $result;
            }
        );
    }
}
