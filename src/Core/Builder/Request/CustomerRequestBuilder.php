<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Customers\CustomerByEmailTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerByIdGetRequest;
use Commercetools\Core\Request\Customers\CustomerByKeyGetRequest;
use Commercetools\Core\Request\Customers\CustomerByTokenGetRequest;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Request\Customers\CustomerDeleteByKeyRequest;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Customers\CustomerEmailConfirmRequest;
use Commercetools\Core\Request\Customers\CustomerEmailTokenRequest;
use Commercetools\Core\Request\Customers\CustomerLoginRequest;
use Commercetools\Core\Model\Cart\CartReference;
use Commercetools\Core\Request\Customers\CustomerPasswordChangeRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordResetRequest;
use Commercetools\Core\Request\Customers\CustomerPasswordTokenRequest;
use Commercetools\Core\Request\Customers\CustomerQueryRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateByKeyRequest;
use Commercetools\Core\Request\Customers\CustomerUpdateRequest;

class CustomerRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#get-customer-by-email-token
     * @param string $token
     * @return CustomerByEmailTokenGetRequest
     */
    public function getByEmailToken($token)
    {
        $request = CustomerByEmailTokenGetRequest::ofToken($token);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#get-customer-by-id
     * @param string $id
     * @return CustomerByIdGetRequest
     */
    public function getById($id)
    {
        $request = CustomerByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#get-customer-by-key
     * @param string $key
     * @return CustomerByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = CustomerByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#get-customer-by-password-token
     * @param string $tokenValue
     * @return CustomerByTokenGetRequest
     */
    public function getByPasswordToken($tokenValue)
    {
        $request = CustomerByTokenGetRequest::ofToken($tokenValue);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#create-customer-sign-up
     * @param CustomerDraft $customer
     * @return CustomerCreateRequest
     */
    public function create(CustomerDraft $customer)
    {
        $request = CustomerCreateRequest::ofDraft($customer);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#delete-customer-by-key
     * @param Customer $customer
     * @return CustomerDeleteByKeyRequest
     */
    public function deleteByKey(Customer $customer)
    {
        $request = CustomerDeleteByKeyRequest::ofKeyAndVersion($customer->getKey(), $customer->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#delete-customer
     * @param Customer $customer
     * @return CustomerDeleteRequest
     */
    public function delete(Customer $customer)
    {
        $request = CustomerDeleteRequest::ofIdAndVersion($customer->getId(), $customer->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#verify-customers-email
     * @param string $tokenValue
     * @return CustomerEmailConfirmRequest
     */
    public function confirmEmail($tokenValue)
    {
        $request = CustomerEmailConfirmRequest::ofToken($tokenValue);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#create-a-token-for-verifying-the-customers-email
     * @param Customer $customer
     * @param int $ttlMinutes
     * @return CustomerEmailTokenRequest
     */
    public function createEmailVerificationToken(Customer $customer, $ttlMinutes)
    {
        $request = CustomerEmailTokenRequest::ofIdVersionAndTtl($customer->getId(), $customer->getVersion(), $ttlMinutes);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#authenticate-customer-sign-in
     * @param string $email
     * @param string $password
     * @param bool $updateProductData
     * @param CartReference|string $anonymousCart
     * @return CustomerLoginRequest
     */
    public function login($email, $password, $updateProductData = false, $anonymousCart = null)
    {
        $request = CustomerLoginRequest::ofEmailPasswordAndUpdateProductData(
            $email,
            $password,
            $updateProductData,
            $anonymousCart
        );
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#change-customers-password
     * @param Customer $customer
     * @param string $currentPassword
     * @param string $newPassword
     * @return CustomerPasswordChangeRequest
     */
    public function changePassword(Customer $customer, $currentPassword, $newPassword)
    {
        $request = CustomerPasswordChangeRequest::ofIdVersionAndPasswords(
            $customer->getId(),
            $customer->getVersion(),
            $currentPassword,
            $newPassword
        );
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#customers-password-reset
     * @param string $tokenValue
     * @param string $newPassword
     * @return CustomerPasswordResetRequest
     */
    public function resetPassword($tokenValue, $newPassword)
    {
        $request = CustomerPasswordResetRequest::ofTokenAndPassword($tokenValue, $newPassword);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#create-a-token-for-resetting-the-customers-password
     * @param string $email
     * @return CustomerPasswordTokenRequest
     */
    public function createResetPasswordToken($email)
    {
        $request = CustomerPasswordTokenRequest::ofEmail($email);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#get-customer-by-id
     *
     * @return CustomerQueryRequest
     */
    public function query()
    {
        $request = CustomerQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#update-customer-by-key
     * @param Customer $customer
     * @return CustomerUpdateByKeyRequest
     */
    public function updateByKey(Customer $customer)
    {
        $request = CustomerUpdateByKeyRequest::ofKeyAndVersion($customer->getKey(), $customer->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-customers.html#update-customer
     * @param Customer $customer
     * @return CustomerUpdateRequest
     */
    public function update(Customer $customer)
    {
        $request = CustomerUpdateRequest::ofIdAndVersion($customer->getId(), $customer->getVersion());
        return $request;
    }

    /**
     * @return CustomerRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
