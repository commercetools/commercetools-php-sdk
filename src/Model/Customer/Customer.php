<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Common\AddressCollection;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * Class Customer
 * @package Sphere\Core\Model\Customer
 * @method string getId()
 * @method Customer setId(string $id)
 * @method int getVersion()
 * @method Customer setVersion(int $version)
 * @method string getCustomerNumber()
 * @method Customer setCustomerNumber(string $customerNumber)
 * @method \DateTime getCreatedAt()
 * @method Customer setCreatedAt(\DateTime $createdAt)
 * @method \DateTime getLastModifiedAt()
 * @method Customer setLastModifiedAt(\DateTime $lastModifiedAt)
 * @method string getEmail()
 * @method Customer setEmail(string $email)
 * @method string getFirstName()
 * @method Customer setFirstName(string $firstName)
 * @method string getLastName()
 * @method Customer setLastName(string $lastName)
 * @method string getPassword()
 * @method Customer setPassword(string $password)
 * @method string getMiddleName()
 * @method Customer setMiddleName(string $middleName)
 * @method string getTitle()
 * @method Customer setTitle(string $title)
 * @method \DateTime getDateOfBirth()
 * @method Customer setDateOfBirth(\DateTime $dateOfBirth)
 * @method string getCompanyName()
 * @method Customer setCompanyName(string $companyName)
 * @method string getVatId()
 * @method Customer setVatId(string $vatId)
 * @method AddressCollection getAddresses()
 * @method Customer setAddresses(AddressCollection $addresses)
 * @method string getDefaultShippingAddressId()
 * @method Customer setDefaultShippingAddressId(string $defaultShippingAddressId)
 * @method string getDefaultBillingAddressId()
 * @method Customer setDefaultBillingAddressId(string $defaultBillingAddressId)
 * @method bool getIsEmailVerified()
 * @method Customer setIsEmailVerified(bool $isEmailVerified)
 * @method string getExternalId()
 * @method Customer setExternalId(string $externalId)
 * @method CustomerGroupReference getCustomerGroup()
 * @method Customer setCustomerGroup(CustomerGroupReference $customerGroup)
 */
class Customer extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'customerNumber' => [static::TYPE => 'string'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'email' => [static::TYPE => 'string'],
            'firstName' => [static::TYPE => 'string'],
            'lastName' => [static::TYPE => 'string'],
            'password' => [static::TYPE => 'string'],
            'middleName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'dateOfBirth' => [static::TYPE => '\DateTime'],
            'companyName' => [static::TYPE => 'string'],
            'vatId' => [static::TYPE => 'string'],
            'addresses' => [static::TYPE => '\Sphere\Core\Model\Common\AddressCollection'],
            'defaultShippingAddressId' => [static::TYPE => 'string'],
            'defaultBillingAddressId' => [static::TYPE => 'string'],
            'isEmailVerified' => [static::TYPE => 'bool'],
            'externalId' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroupReference'],
        ];
    }
}
