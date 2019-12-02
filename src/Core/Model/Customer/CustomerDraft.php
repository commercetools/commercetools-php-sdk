<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:23
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Common\AddressCollection;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;
use Commercetools\Core\Model\Store\StoreReferenceCollection;
use DateTime;
use Commercetools\Core\Model\Common\DateDecorator;

/**
 * @package Commercetools\Core\Model\Customer
 * @link https://docs.commercetools.com/http-api-projects-customers.html#customerdraft
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
 * @method DateDecorator getDateOfBirth()
 * @method CustomerDraft setDateOfBirth(DateTime $dateOfBirth = null)
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
 * @method int getDefaultShippingAddress()
 * @method CustomerDraft setDefaultShippingAddress(int $defaultShippingAddress = null)
 * @method int getDefaultBillingAddress()
 * @method CustomerDraft setDefaultBillingAddress(int $defaultBillingAddress = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method CustomerDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getLocale()
 * @method array getBillingAddresses()
 * @method CustomerDraft setBillingAddresses(array $billingAddresses = null)
 * @method array getShippingAddresses()
 * @method CustomerDraft setShippingAddresses(array $shippingAddresses = null)
 * @method string getSalutation()
 * @method CustomerDraft setSalutation(string $salutation = null)
 * @method string getKey()
 * @method CustomerDraft setKey(string $key = null)
 * @method string getAnonymousId()
 * @method CustomerDraft setAnonymousId(string $anonymousId = null)
 * @method StoreReferenceCollection getStores()
 * @method CustomerDraft setStores(StoreReferenceCollection $stores = null)
 */
class CustomerDraft extends JsonObject
{
    use LocaleTrait;

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
                static::TYPE => DateTime::class,
                static::DECORATOR => DateDecorator::class
            ],
            'companyName' => [static::TYPE => 'string'],
            'vatId' => [static::TYPE => 'string'],
            'isEmailVerified' => [static::TYPE => 'bool'],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class],
            'addresses' => [static::TYPE => AddressCollection::class],
            'defaultShippingAddress' => [static::TYPE => 'int'],
            'defaultBillingAddress' => [static::TYPE => 'int'],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class],
            'locale' => [static::TYPE => 'string'],
            'billingAddresses' => [static::TYPE => 'array'],
            'shippingAddresses' => [static::TYPE => 'array'],
            'salutation' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'anonymousId' => [static::TYPE => 'string'],
            'stores' => [static::TYPE => StoreReferenceCollection::class],
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
