<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:23
 */

namespace Sphere\Core\Model\Customer;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;

/**
 * Class CustomerDraft
 * @package Sphere\Core\Model\Customer
 * @link http://dev.sphere.io/http-api-projects-customers.html#create-customer
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
 */
class CustomerDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'customerNumber' => [self::TYPE => 'string'],
            'email' => [self::TYPE => 'string'],
            'title' => [self::TYPE => 'string'],
            'firstName' => [self::TYPE => 'string'],
            'middleName' => [self::TYPE => 'string'],
            'lastName' => [self::TYPE => 'string'],
            'password' => [self::TYPE => 'string'],
            'anonymousCartId' => [self::TYPE => 'string'],
            'externalId' => [self::TYPE => 'string'],
        ];
    }

    /**
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $password
     * @param Context|callable $context
     */
    public function __construct($email, $firstName, $lastName, $password, $context = null)
    {
        $this->setContext($context);
        $this->setEmail($email);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setPassword($password);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static($data['email'], $data['firstName'], $data['lastName'], $data['password'], $context);
        $draft->setRawData($data);

        return $draft;
    }
}
