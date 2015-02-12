<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 14:35
 */

namespace Sphere\Core\Request\Customer;


use Sphere\Core\Model\Common\Address;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CustomerUpdateRequest
 * @package Sphere\Core\Request\Customer
 * @method static CustomerUpdateRequest of(string $id, int $version, array $actions = [])
 */
class CustomerUpdateRequest extends AbstractUpdateRequest
{
    const FIRST_NAME = 'firstName';
    const LAST_NAME = 'lastName';
    const MIDDLE_NAME = 'middleName';
    const TITLE = 'title';
    const EMAIL = 'email';
    const ADDRESS = 'address';
    const ADDRESS_ID = 'addressId';
    const CUSTOMER_GROUP = 'customerGroup';
    const CUSTOMER_NUMBER = 'customerNumber';
    const EXTERNAL_ID = 'externalId';
    const COMPANY_NAME = 'companyName';
    const DATE_OF_BIRTH = 'dateOfBirth';
    const VAT_ID = 'vatId';

    const CHANGE_NAME = 'changeName';
    const CHANGE_EMAIL = 'changeEmail';
    const ADD_ADDRESS = 'addAddress';
    const CHANGE_ADDRESS = 'changeAddress';
    const REMOVE_ADDRESS = 'removeAddress';
    const SET_DEFAULT_SHIPPING_ADDRESS = 'setDefaultShippingAddress';
    const SET_DEFAULT_BILLING_ADDRESS = 'setDefaultBillingAddress';
    const SET_CUSTOMER_GROUP = 'setCustomerGroup';
    const SET_CUSTOMER_NUMBER = 'setCustomerNumber';
    const SET_EXTERNAL_ID = 'setExternalId';
    const SET_COMPANY_NAME = 'setCompanyName';
    const SET_DATE_OF_BIRTH = 'setDateOfBirth';
    const SET_VAT_ID = 'setVatId';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     */
    public function __construct($id, $version, array $actions = [])
    {
        parent::__construct(CustomersEndpoint::endpoint(), $id, $version, $actions);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $middleName
     * @param string $title
     * @return $this
     */
    public function changeName($firstName, $lastName, $middleName = null, $title = null)
    {
        $action = [
            static::ACTION => static::CHANGE_NAME,
            static::FIRST_NAME => $firstName,
            static::LAST_NAME => $lastName,
        ];
        $action = $this->addValue($action, static::MIDDLE_NAME, $middleName);
        $action = $this->addValue($action, static::TITLE, $title);

        return $this->addAction($action);
    }

    /**
     * @param string $email
     * @return $this
     */
    public function changeEmail($email)
    {
        return $this->addAction([
            static::ACTION => static::CHANGE_EMAIL,
            static::EMAIL => $email
        ]);
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function addAddress(Address $address)
    {
        return $this->addAction([
            static::ACTION => static::ADD_ADDRESS,
            static::ADDRESS => $address
        ]);
    }

    /**
     * @param string $addressId
     * @param Address $address
     * @return $this
     */
    public function changeAddress($addressId, Address $address)
    {
        return $this->addAction([
            static::ACTION => static::ADD_ADDRESS,
            static::ADDRESS_ID => $addressId,
            static::ADDRESS => $address,
        ]);
    }

    /**
     * @param string $addressId
     * @return $this
     */
    public function removeAddress($addressId)
    {
        return $this->addAction([
            static::ACTION => static::REMOVE_ADDRESS,
            static::ADDRESS_ID => $addressId,
        ]);
    }

    /**
     * @param string $action
     * @param string $field
     * @param $value
     * @return $this
     */
    protected function getOptionalAction($action, $field, $value)
    {
        $action = [
            static::ACTION => $action,
        ];
        $action = $this->addValue($action, $field, $value);

        return $this->addAction($action);
    }

    /**
     * @param string $addressId
     * @return $this
     */
    public function setDefaultShippingAddress($addressId = null)
    {
        return $this->getOptionalAction(static::SET_DEFAULT_SHIPPING_ADDRESS, static::ADDRESS_ID, $addressId);
    }

    /**
     * @param string $addressId
     * @return CustomerUpdateRequest
     */
    public function setDefaultBillingAddress($addressId = null)
    {
        return $this->getOptionalAction(static::SET_DEFAULT_BILLING_ADDRESS, static::ADDRESS_ID, $addressId);
    }

    /**
     * @param CustomerGroupReference $customerGroup
     * @return $this
     */
    public function setCustomerGroup(CustomerGroupReference $customerGroup)
    {
        return $this->addAction([
            static::ACTION => static::SET_CUSTOMER_GROUP,
            static::CUSTOMER_GROUP => $customerGroup
        ]);
    }

    /**
     * @param string $customerNumber
     * @return $this
     */
    public function setCustomerNumber($customerNumber = null)
    {
        return $this->getOptionalAction(static::SET_CUSTOMER_NUMBER, static::CUSTOMER_NUMBER, $customerNumber);
    }

    /**
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId = null)
    {
        return $this->getOptionalAction(static::SET_EXTERNAL_ID, static::EXTERNAL_ID, $externalId);
    }

    /**
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName($companyName = null)
    {
        return $this->getOptionalAction(static::SET_COMPANY_NAME, static::COMPANY_NAME, $companyName);
    }

    /**
     * @param \DateTime $dateOfBirth
     * @return CustomerUpdateRequest
     */
    public function setDateOfBirth(\DateTime $dateOfBirth = null)
    {
        return $this->getOptionalAction(
            static::SET_DATE_OF_BIRTH,
            static::DATE_OF_BIRTH,
            ($dateOfBirth ? $dateOfBirth->format('Y-m-d'): null)
        );
    }

    /**
     * @param string $vatId
     * @return $this
     */
    public function setVatId($vatId = null)
    {
        return $this->getOptionalAction(static::SET_VAT_ID, static::VAT_ID, $vatId);
    }
}
