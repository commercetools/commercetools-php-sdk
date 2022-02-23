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
use Commercetools\Core\Model\Common\DateDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\Customer
 * @link https://docs.commercetools.com/http-api-projects-me-profile.html#mycustomerdraft
 * @method string getEmail()
 * @method MyCustomerDraft setEmail(string $email = null)
 * @method string getPassword()
 * @method MyCustomerDraft setPassword(string $password = null)
 * @method string getFirstName()
 * @method MyCustomerDraft setFirstName(string $firstName = null)
 * @method string getMiddleName()
 * @method MyCustomerDraft setMiddleName(string $middleName = null)
 * @method string getLastName()
 * @method MyCustomerDraft setLastName(string $lastName = null)
 * @method string getTitle()
 * @method MyCustomerDraft setTitle(string $title = null)
 * @method DateDecorator getDateOfBirth()
 * @method MyCustomerDraft setDateOfBirth(DateTime $dateOfBirth = null)
 * @method string getCompanyName()
 * @method MyCustomerDraft setCompanyName(string $companyName = null)
 * @method string getVatId()
 * @method MyCustomerDraft setVatId(string $vatId = null)
 * @method AddressCollection getAddresses()
 * @method MyCustomerDraft setAddresses(AddressCollection $addresses = null)
 * @method int getDefaultShippingAddress()
 * @method MyCustomerDraft setDefaultShippingAddress(int $defaultShippingAddress = null)
 * @method int getDefaultBillingAddress()
 * @method MyCustomerDraft setDefaultBillingAddress(int $defaultBillingAddress = null)
 * @method CustomFieldObjectDraft getCustom()
 * @method MyCustomerDraft setCustom(CustomFieldObjectDraft $custom = null)
 * @method string getLocale()
 */
class MyCustomerDraft extends JsonObject
{
    use LocaleTrait;

    public function fieldDefinitions()
    {
        return [
            'email' => [static::TYPE => 'string'],
            'password' => [static::TYPE => 'string'],
            'firstName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'middleName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'lastName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'title' => [static::TYPE => 'string', static::OPTIONAL => true],
            'dateOfBirth' => [
                static::TYPE => DateTime::class,
                static::OPTIONAL => true,
                static::DECORATOR => DateDecorator::class
            ],
            'companyName' => [static::TYPE => 'string', static::OPTIONAL => true],
            'vatId' => [static::TYPE => 'string', static::OPTIONAL => true],
            'addresses' => [static::TYPE => AddressCollection::class, static::OPTIONAL => true],
            'defaultShippingAddress' => [static::TYPE => 'int', static::OPTIONAL => true],
            'defaultBillingAddress' => [static::TYPE => 'int', static::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObjectDraft::class, static::OPTIONAL => true],
            'locale' => [static::TYPE => 'string', static::OPTIONAL => true],
        ];
    }

    /**
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $password
     * @param Context|callable $context
     * @return MyCustomerDraft
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
