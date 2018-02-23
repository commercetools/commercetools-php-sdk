<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\DateDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\Customer
 * @link https://docs.commercetools.com/http-api-projects-customers.html#customer
 * @method string getId()
 * @method Customer setId(string $id = null)
 * @method int getVersion()
 * @method Customer setVersion(int $version = null)
 * @method string getCustomerNumber()
 * @method Customer setCustomerNumber(string $customerNumber = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Customer setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Customer setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getEmail()
 * @method Customer setEmail(string $email = null)
 * @method string getFirstName()
 * @method Customer setFirstName(string $firstName = null)
 * @method string getLastName()
 * @method Customer setLastName(string $lastName = null)
 * @method string getPassword()
 * @method Customer setPassword(string $password = null)
 * @method string getMiddleName()
 * @method Customer setMiddleName(string $middleName = null)
 * @method string getTitle()
 * @method Customer setTitle(string $title = null)
 * @method DateDecorator getDateOfBirth()
 * @method Customer setDateOfBirth(DateTime $dateOfBirth = null)
 * @method string getCompanyName()
 * @method Customer setCompanyName(string $companyName = null)
 * @method string getVatId()
 * @method Customer setVatId(string $vatId = null)
 * @method AddressCollection getAddresses()
 * @method Customer setAddresses(AddressCollection $addresses = null)
 * @method string getDefaultShippingAddressId()
 * @method Customer setDefaultShippingAddressId(string $defaultShippingAddressId = null)
 * @method string getDefaultBillingAddressId()
 * @method Customer setDefaultBillingAddressId(string $defaultBillingAddressId = null)
 * @method bool getIsEmailVerified()
 * @method Customer setIsEmailVerified(bool $isEmailVerified = null)
 * @method string getExternalId()
 * @method Customer setExternalId(string $externalId = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method Customer setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method CustomFieldObject getCustom()
 * @method Customer setCustom(CustomFieldObject $custom = null)
 * @method string getLocale()
 * @method array getShippingAddressIds()
 * @method Customer setShippingAddressIds(array $shippingAddressIds = null)
 * @method array getBillingAddressIds()
 * @method Customer setBillingAddressIds(array $billingAddressIds = null)
 * @method string getSalutation()
 * @method Customer setSalutation(string $salutation = null)
 * @method string getKey()
 * @method Customer setKey(string $key = null)
 * @method CustomerReference getReference()
 */
class Customer extends Resource
{
    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'customerNumber' => [static::TYPE => 'string'],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'email' => [static::TYPE => 'string'],
            'firstName' => [static::TYPE => 'string'],
            'lastName' => [static::TYPE => 'string'],
            'password' => [static::TYPE => 'string'],
            'middleName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'dateOfBirth' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateDecorator::class
            ],
            'companyName' => [static::TYPE => 'string'],
            'vatId' => [static::TYPE => 'string'],
            'addresses' => [static::TYPE => AddressCollection::class],
            'defaultShippingAddressId' => [static::TYPE => 'string'],
            'defaultBillingAddressId' => [static::TYPE => 'string'],
            'isEmailVerified' => [static::TYPE => 'bool'],
            'externalId' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
            'locale' => [static::TYPE => 'string'],
            'shippingAddressIds' => [static::TYPE => 'array'],
            'billingAddressIds' => [static::TYPE => 'array'],
            'salutation' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @return Address|null
     */
    public function getDefaultShippingAddress()
    {
        if (!is_null($this->getAddresses())) {
            return $this->getAddresses()->getById($this->getDefaultShippingAddressId());
        }
        return null;
    }

    /**
     * @return Address|null
     */
    public function getDefaultBillingAddress()
    {
        if (!is_null($this->getAddresses())) {
            return $this->getAddresses()->getById($this->getDefaultBillingAddressId());
        }
        return null;
    }
}
