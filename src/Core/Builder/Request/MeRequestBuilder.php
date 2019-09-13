<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\MyCustomerDraft;
use Commercetools\Core\Request\Me\MeDeleteRequest;
use Commercetools\Core\Request\Me\MeEmailConfirmRequest;
use Commercetools\Core\Request\Me\MeGetRequest;
use Commercetools\Core\Request\Me\MeLoginRequest;
use Commercetools\Core\Request\Me\MePasswordChangeRequest;
use Commercetools\Core\Request\Me\MePasswordResetRequest;
use Commercetools\Core\Request\Me\MeSignupRequest;
use Commercetools\Core\Request\Me\MeUpdateRequest;

class MeRequestBuilder
{
    /**
     * @return MeGetRequest
     */
    public function get()
    {
        return MeGetRequest::of();
    }

    /**
     * @param Customer $customer
     * @return MeDeleteRequest
     */
    public function delete(Customer $customer)
    {
        return MeDeleteRequest::ofVersion($customer->getVersion());
    }

    /**
     * @param Customer $customer
     * @return MeUpdateRequest
     */
    public function update(Customer $customer)
    {
        return MeUpdateRequest::ofVersion($customer->getVersion());
    }

    /**
     * @param MyCustomerDraft $myCustomerDraft
     * @return MeSignupRequest
     */
    public function signUp(MyCustomerDraft $myCustomerDraft)
    {
        return MeSignupRequest::ofCustomer($myCustomerDraft);
    }

    /**
     * @param $email
     * @param $password
     * @param bool $updateProductData
     * @param string $anonymousCartId
     * @return MeLoginRequest
     */
    public function login($email, $password, $updateProductData = false, $anonymousCartId = null)
    {
        return MeLoginRequest::ofEmailPasswordAndUpdateProductData(
            $email,
            $password,
            $updateProductData,
            $anonymousCartId
        );
    }

    /**
     * @param string $tokenValue
     * @return MeEmailConfirmRequest
     */
    public function confirmEmail($tokenValue)
    {
        return MeEmailConfirmRequest::ofToken($tokenValue);
    }

    /**
     * @return MeCartRequestBuilder
     */
    public function carts()
    {
        return new MeCartRequestBuilder();
    }

    /**
     * @return MeOrderRequestBuilder
     */
    public function orders()
    {
        return new MeOrderRequestBuilder();
    }

    /**
     * @return MeShoppingListRequestBuilder
     */
    public function shoppingLists()
    {
        return new MeShoppingListRequestBuilder();
    }

    /**
     * @param Customer $customer
     * @param string $currentPassword
     * @param string $newPassword
     * @return MePasswordChangeRequest
     */
    public function changePassword(Customer $customer, $currentPassword, $newPassword)
    {
        return MePasswordChangeRequest::ofVersionAndPasswords(
            $customer->getVersion(),
            $currentPassword,
            $newPassword
        );
    }

    /**
     * @param string $tokenValue
     * @param string $newPassword
     * @return MePasswordResetRequest
     */
    public function resetPassword($tokenValue, $newPassword)
    {
        return MePasswordResetRequest::ofTokenAndPassword($tokenValue, $newPassword);
    }
}
