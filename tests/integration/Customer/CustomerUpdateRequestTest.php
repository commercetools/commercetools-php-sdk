<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Customer;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\CustomerGroup\CustomerGroup;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupDraft;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\StringType;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupCreateRequest;
use Commercetools\Core\Request\CustomerGroups\CustomerGroupDeleteRequest;
use Commercetools\Core\Request\Customers\Command\CustomerAddAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerChangeEmailAction;
use Commercetools\Core\Request\Customers\Command\CustomerRemoveAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCompanyNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerGroupAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetCustomerNumberAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDateOfBirthAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultBillingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetDefaultShippingAddressAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetExternalIdAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetFirstNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetLastNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetMiddleNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetTitleNameAction;
use Commercetools\Core\Request\Customers\Command\CustomerSetVatIdAction;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;

class CustomerUpdateRequestTest extends ApiTestCase
{
    /**
     * @var CustomerDeleteRequest
     */
    private $customerDeleteRequest;

    /**
     * @var CustomerGroup
     */
    private $customerGroup;

    /**
     * @var Type
     */
    private $type;

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

        $this->cleanupRequests[] = $this->customerDeleteRequest = CustomerDeleteRequest::ofIdAndVersion(
            $result->getCustomer()->getId(),
            $result->getCustomer()->getVersion()
        );
        return $result->getCustomer();
    }

    public function testCustomerEmail()
    {
        $draft = $this->getDraft('email');
        $customer = $this->createCustomer($draft);

        $email = 'new-' . $this->getTestRun() . '@example.com';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerChangeEmailAction::ofEmail($email))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($email, $customer->getEmail());
    }

    public function testFirstName()
    {
        $draft = $this->getDraft('firstName');
        $customer = $this->createCustomer($draft);

        $firstName = 'new-' . $this->getTestRun() . '-firstName';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetFirstNameAction::of()->setFirstName($firstName))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($firstName, $customer->getFirstName());
    }

    public function testLastName()
    {
        $draft = $this->getDraft('lastName');
        $customer = $this->createCustomer($draft);

        $lastName = 'new-' . $this->getTestRun() . '-lastName';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetLastNameAction::of()->setLastName($lastName))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($lastName, $customer->getLastName());
    }

    public function testMiddleName()
    {
        $draft = $this->getDraft('middleName');
        $customer = $this->createCustomer($draft);

        $middleName = 'new-' . $this->getTestRun() . '-middleName';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetMiddleNameAction::of()->setMiddleName($middleName))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($middleName, $customer->getMiddleName());
    }

    public function testTitle()
    {
        $draft = $this->getDraft('title');
        $customer = $this->createCustomer($draft);

        $title = 'new-' . $this->getTestRun() . '-title';

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetTitleNameAction::of()->setTitle($title))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($title, $customer->getTitle());
    }

    public function testAddress()
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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertCount(1, $customer->getAddresses());
        $this->assertSame($address->getFirstName(), $customer->getAddresses()->current()->getFirstName());

        $address = Address::of()
            ->setCountry('DE')
            ->setLastName('new-' . $this->getTestRun() . '-lastName');
        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                CustomerChangeAddressAction::ofAddressIdAndAddress(
                    $customer->getAddresses()->current()->getId(),
                    $address
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertNull($customer->getAddresses()->current()->getFirstName());
        $this->assertSame($address->getLastName(), $customer->getAddresses()->current()->getLastName());

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerRemoveAddressAction::ofAddressId($customer->getAddresses()->current()->getId()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());
        $this->assertCount(0, $customer->getAddresses());
    }

    public function testDefaultShippingAddress()
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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertCount(1, $customer->getAddresses());

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                CustomerSetDefaultShippingAddressAction::of()->setAddressId(
                    $customer->getAddresses()->current()->getId()
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($address->getFirstName(), $customer->getDefaultShippingAddress()->getFirstName());
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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($companyName, $customer->getCompanyName());
    }

    public function testDateOfBirth()
    {
        $draft = $this->getDraft('date-of-birth');
        $customer = $this->createCustomer($draft);

        $dateOfBirth = new \DateTime();

        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(CustomerSetDateOfBirthAction::of()->setDateOfBirth($dateOfBirth))
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertEquals($dateOfBirth->modify('today'), $customer->getDateOfBirth()->getDateTime());
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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

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
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($type->getId(), $customer->getCustom()->getType()->getId());
    }

    public function testCustomField()
    {
        $type = $this->getType('key-' . $this->getTestRun(), 'customer');
        $draft = $this->getDraft('custom-field');
        $draft->setCustom(CustomFieldObjectDraft::ofType($type->getReference()));
        $customer = $this->createCustomer($draft);


        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion())
            ->addAction(
                SetCustomFieldAction::ofName('testField')
                    ->setValue($this->getTestRun())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $customer = $request->mapResponse($response);
        $this->customerDeleteRequest->setVersion($customer->getVersion());

        $this->assertSame($this->getTestRun(), $customer->getCustom()->getFields()->getTestField());
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->deleteCustomerGroup();
        $this->deleteType();
    }

    /**
     * @param $name
     * @return CustomerGroupDraft
     */
    protected function getCustomerGroupDraft($name)
    {
        $draft = CustomerGroupDraft::ofGroupName(
            'test-' . $this->getTestRun() . '-' . $name
        );

        return $draft;
    }

    protected function getCustomerGroup()
    {
        if (is_null($this->customerGroup)) {
            $draft = $this->getCustomerGroupDraft('group');
            $request = CustomerGroupCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->customerGroup = $request->mapResponse($response);
        }

        return $this->customerGroup;
    }

    protected function deleteCustomerGroup()
    {
        if (!is_null($this->customerGroup)) {
            $request = CustomerGroupDeleteRequest::ofIdAndVersion(
                $this->customerGroup->getId(),
                $this->customerGroup->getVersion()
            );
            $request->executeWithClient($this->getClient());
        }

        $this->customerGroup = null;
    }

    private function getType($key, $type)
    {
        if (is_null($this->type)) {
            $name = $this->getTestRun() . '-name';
            $typeDraft = TypeDraft::ofKeyNameDescriptionAndResourceTypes(
                $key,
                LocalizedString::ofLangAndText('en', $name),
                LocalizedString::ofLangAndText('en', $name),
                [$type]
            );
            $typeDraft->setFieldDefinitions(
                FieldDefinitionCollection::of()
                    ->add(
                        FieldDefinition::of()
                            ->setName('testField')
                            ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
                            ->setRequired(false)
                            ->setType(StringType::of())
                    )
            );
            $request = TypeCreateRequest::ofDraft($typeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }

        return $this->type;
    }

    private function deleteType()
    {
        if (!is_null($this->type)) {
            $request = TypeDeleteRequest::ofIdAndVersion(
                $this->type->getId(),
                $this->type->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }
        $this->type = null;
    }
}
