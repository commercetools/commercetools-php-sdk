<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\Customers\CustomerByEmailTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerByKeyGetRequest;
use Commercetools\Core\Request\Customers\CustomerByTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerEmailConfirmRequest;
use Commercetools\Core\Request\Customers\CustomerEmailTokenRequest;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordChangeRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordResetRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordTokenRequest;
use Commercetools\Core\Request\Customers\CustomerQueryRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;

class CustomerRequestBuilder
{
    /**
     * @return CustomerQueryRequest
     */
    public function query()
    {
        return CustomerQueryRequest::of();
    }

    /**
     * @param Customer $customer
     * @return CustomerUpdateRequest
     */
    public function update(Customer $customer)
    {
        return CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion());
    }

    /**
     * @param Customer $customer
     * @return CustomerUpdateByKeyRequest
     */
    public function updateByKey(Customer $customer)
    {
        return CustomerUpdateByKeyRequest::ofKeyAndVersion($customer->getKey(), $customer->getVersion());
    }

    /**
     * @param CustomerDraft $customerDraft
     * @return CustomerCreateRequest
     */
    public function create(CustomerDraft $customerDraft)
    {
        return CustomerCreateRequest::ofDraft($customerDraft);
    }

    /**
     * @param Customer $customer
     * @return CustomerDeleteRequest
     */
    public function delete(Customer $customer)
    {
        return CustomerDeleteRequest::ofIdAndVersion($customer->getId(), $customer->getVersion());
    }

    /**
     * @param Customer $customer
     * @return CustomerDeleteByKeyRequest
     */
    public function deleteByKey(Customer $customer)
    {
        return CustomerDeleteByKeyRequest::ofKeyAndVersion($customer->getKey(), $customer->getVersion());
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $updateProductData
     * @param string $anonymousCartId
     * @return CustomerLoginRequest
     */
    public function login($email, $password, $updateProductData = false, $anonymousCartId = null)
    {
        return CustomerLoginRequest::ofEmailPasswordAndUpdateProductData(
            $email,
            $password,
            $updateProductData,
            $anonymousCartId
        );
    }

    /**
     * @param Customer $customer
     * @param string $currentPassword
     * @param string $newPassword
     * @return CustomerPasswordChangeRequest
     */
    public function changePassword(Customer $customer, $currentPassword, $newPassword)
    {
        return CustomerPasswordChangeRequest::ofIdVersionAndPasswords(
            $customer->getId(),
            $customer->getVersion(),
            $currentPassword,
            $newPassword
        );
    }

    /**
     * @param string $email
     * @return CustomerPasswordTokenRequest
     */
    public function createResetPasswordToken($email)
    {
        return CustomerPasswordTokenRequest::ofEmail($email);
    }

    /**
     * @param string $tokenValue
     * @param string $newPassword
     * @return CustomerPasswordResetRequest
     */
    public function resetPassword($tokenValue, $newPassword)
    {
        return CustomerPasswordResetRequest::ofTokenAndPassword($tokenValue, $newPassword);
    }

    /**
     * @param Customer $customer
     * @param int $ttlMinutes
     * @return CustomerEmailTokenRequest
     */
    public function createEmailVerificationToken(Customer $customer, $ttlMinutes)
    {
        return CustomerEmailTokenRequest::ofIdVersionAndTtl($customer->getId(), $customer->getVersion(), $ttlMinutes);
    }

    /**
     * @param string $tokenValue
     * @return CustomerEmailConfirmRequest
     */
    public function confirmEmail($tokenValue)
    {
        return CustomerEmailConfirmRequest::ofToken($tokenValue);
    }

    /**
     * @param string $id
     * @return CustomerByIdGetRequest
     */
    public function getById($id)
    {
        return CustomerByIdGetRequest::ofId($id);
    }

    /**
     * @param string $key
     * @return CustomerByKeyGetRequest
     */
    public function getByKey($key)
    {
        return CustomerByKeyGetRequest::ofKey($key);
    }

    /**
     * @param string $tokenValue
     * @return CustomerByTokenGetRequest
     */
    public function getByPasswordToken($tokenValue)
    {
        return CustomerByTokenGetRequest::ofToken($tokenValue);
    }

    /**
     * @param string $tokenValue
     * @return CustomerByEmailTokenGetRequest
     */
    public function getByEmailToken($tokenValue)
    {
        return CustomerByEmailTokenGetRequest::ofToken($tokenValue);
    }
}
