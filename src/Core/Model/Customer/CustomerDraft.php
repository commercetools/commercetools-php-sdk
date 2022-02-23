<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:23
 */

namespace Commercetools\Core\Model\Customer;

use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LocaleTrait;
use Commercetools\Core\Model\Common\ResourceIdentifier;
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
 * @method CartReference getAnonymousCart()
 * @method CustomerDraft setAnonymousCart(CartReference $anonymousCart = null)
 */
class CustomerDraft extends JsonObject
{
    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'customerNumber' => [static::TYPE => 'string', static::OPTIONAL => true],
            'email' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string', static::OPTIONAL => true],
            'firstName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'middleName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'lastName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'password' => [static::TYPE => 'string'],
            'anonymousCartId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'externalId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'dateOfBirth' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateDecorator::class
            ],
            'companyName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'vatId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'isEmailVerified' => [static::TYPE => 'bool', static::OPTIONAL => true],
            'customerGroup' => [static::TYPE => CustomerGroupReference::class, static::OPTIONAL => true],
            'addresses' => [static::TYPE => AddressCollection::class, static::OPTIONAL => true],
            'defaultShippingAddress' => [static::TYPE => 'int', static::OPTIONAL => true],
            'defaultBillingAddress' => [static::TYPE => 'int', static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'locale' => [static::TYPE => 'string', static::OPTIONAL => true],
            'billingAddresses' => [static::TYPE => 'array', static::OPTIONAL => true],
            'shippingAddresses' => [static::TYPE => 'array', static::OPTIONAL => true],
            'salutation' => [static::TYPE => 'string', static::OPTIONAL => true],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'anonymousId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'stores' => [static::TYPE => StoreReferenceCollection::class, static::OPTIONAL => true],
            'anonymousCart' => [static::TYPE => CartReference::class, static::OPTIONAL => true],
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
