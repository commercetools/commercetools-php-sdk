<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:23
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Common\AddressCollection;

/**
 * @package Commercetools\Core\Model\Customer
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#create-customer
 * @method string getCustomerNumber()
 * @method string getEmail()
 * @method string getTitle()
 * @method string getFirstName()
 * @method string getMiddleName()
 * @method string getLastName()
 * @method string getPassword()
 * @method string getAnonymousCartId()
 * @method string getExternalId()
 * @method CustomerDraft setCustomerNumber(string $customerNumber = null)
 * @method CustomerDraft setEmail(string $email = null)
 * @method CustomerDraft setTitle(string $title = null)
 * @method CustomerDraft setFirstName(string $firstName = null)
 * @method CustomerDraft setMiddleName(string $middleName = null)
 * @method CustomerDraft setLastName(string $lastName = null)
 * @method CustomerDraft setPassword(string $password = null)
 * @method CustomerDraft setAnonymousCartId(string $anonymousCartId = null)
 * @method CustomerDraft setExternalId(string $externalId = null)
 * @method DateTimeDecorator getDateOfBirth()
 * @method CustomerDraft setDateOfBirth(\DateTime $dateOfBirth = null)
 * @method string getCompanyName()
 * @method CustomerDraft setCompanyName(string $companyName = null)
 * @method string getVatId()
 * @method CustomerDraft setVatId(string $vatId = null)
 * @method bool getIsEmailVerified()
 * @method CustomerDraft setIsEmailVerified(bool $isEmailVerified = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method CustomerDraft setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method AddressCollection getAddresses()
 * @method CustomerDraft setAddresses(AddressCollection $addresses = null)
 * @method int getDefaultShippingAddressId()
 * @method CustomerDraft setDefaultShippingAddressId(int $defaultShippingAddressId = null)
 * @method int getDefaultBillingAddressId()
 * @method CustomerDraft setDefaultBillingAddressId(int $defaultBillingAddressId = null)
 */
class CustomerDraft extends JsonObject
{

    public function fieldDefinitions()
    {
        return [
            'customerNumber' => [static::TYPE => 'string'],
            'email' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'firstName' => [static::TYPE => 'string'],
            'middleName' => [static::TYPE => 'string'],
            'lastName' => [static::TYPE => 'string'],
            'password' => [static::TYPE => 'string'],
            'anonymousCartId' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string'],
            'dateOfBirth' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'companyName' => [static::TYPE => 'string'],
            'vatId' => [static::TYPE => 'string'],
            'isEmailVerified' => [static::TYPE => 'bool'],
            'customerGroup' => [static::TYPE => '\Commercetools\Core\Model\CustomerGroup\CustomerGroupReference'],
            'addresses' => [static::TYPE => '\Commercetools\Core\Model\Common\AddressCollection'],
            'defaultShippingAddressId' => [static::TYPE => 'int'],
            'defaultBillingAddressId' => [static::TYPE => 'int'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObjectDraft'],
        ];
    }

    /**
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $password
     * @param Context|callable $context
     * @return CustomerDraft
     */
    public static function ofEmailNameAndPassword($email, $firstName, $lastName, $password, $context = null)
    {
        $draft = static::of($context);
        return $draft->setEmail($email)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setPassword($password);
    }
}
