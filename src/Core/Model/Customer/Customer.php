<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\DateDecorator;
use Commercetools\Core\Model\Store\StoreReference;
use Commercetools\Core\Model\Store\StoreReferenceCollection;
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
 * @method CreatedBy getCreatedBy()
 * @method Customer setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method Customer setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method StoreReferenceCollection getStores()
 * @method Customer setStores(StoreReferenceCollection $stores = null)
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
            'customerNumber' => [static::TYPE => 'string', static::OPTIONAL => true],
            'createdAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'email' => [static::TYPE => 'string'],
            'firstName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'lastName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'password' => [static::TYPE => 'string'],
            'middleName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'title' => [static::TYPE => 'string', static::OPTIONAL => true],
            'dateOfBirth' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateDecorator::class
            ],
            'companyName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'vatId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'addresses' => [static::TYPE => AddressCollection::class],
            'defaultShippingAddressId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'defaultBillingAddressId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'isEmailVerified' => [static::TYPE => 'bool'],
            'externalId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class, static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            'locale' => [static::TYPE => 'string', static::OPTIONAL => true],
            'shippingAddressIds' => [static::TYPE => 'array', static::OPTIONAL => true],
            'billingAddressIds' => [static::TYPE => 'array', static::OPTIONAL => true],
            'salutation' => [static::TYPE => 'string', static::OPTIONAL => true],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'createdBy' => [static::TYPE => CreatedBy::class, static::OPTIONAL => true],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
            'stores' => [static::TYPE => StoreReferenceCollection::class, static::OPTIONAL => true],
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
