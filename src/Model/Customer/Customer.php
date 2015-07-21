<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Common\AddressCollection;
use Sphere\Core\Model\Common\Document;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * @package Sphere\Core\Model\Customer
 * @link http://dev.sphere.io/http-api-projects-customers.html#customer
 * @method string getId()
 * @method Customer setId(string $id = null)
 * @method int getVersion()
 * @method Customer setVersion(int $version = null)
 * @method string getCustomerNumber()
 * @method Customer setCustomerNumber(string $customerNumber = null)
 * @method \DateTime getCreatedAt()
 * @method Customer setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Customer setLastModifiedAt(\DateTime $lastModifiedAt = null)
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
 * @method \DateTime getDateOfBirth()
 * @method Customer setDateOfBirth(\DateTime $dateOfBirth = null)
 * @method string getCompanyName()
 * @method Customer setCompanyName(string $companyName = null)
 * @method string getVatId()
 * @method Customer setVatId(string $vatId = null)
 * @method AddressCollection getAddresses()
 * @method Customer setAddresses(AddressCollection $addresses = null)
 * @method int getDefaultShippingAddressId()
 * @method Customer setDefaultShippingAddressId(int $defaultShippingAddressId = null)
 * @method int getDefaultBillingAddressId()
 * @method Customer setDefaultBillingAddressId(int $defaultBillingAddressId = null)
 * @method bool getIsEmailVerified()
 * @method Customer setIsEmailVerified(bool $isEmailVerified = null)
 * @method string getExternalId()
 * @method Customer setExternalId(string $externalId = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method Customer setCustomerGroup(CustomerGroupReference $customerGroup = null)
 */
class Customer extends Document
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
            'defaultShippingAddressId' => [static::TYPE => 'int'],
            'defaultBillingAddressId' => [static::TYPE => 'int'],
            'isEmailVerified' => [static::TYPE => 'bool'],
            'externalId' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroupReference'],
        ];
    }
}
