<?php
// phpcs:ignoreFile
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Payments\PaymentByIdGetRequest;
use Commercetools\Core\Request\Payments\PaymentByKeyGetRequest;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Request\Payments\PaymentDeleteByKeyRequest;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentQueryRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateByKeyRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateRequest;

class PaymentRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#get-payment-by-id
     * @param string $id
     * @return PaymentByIdGetRequest
     */
    public function getById($id)
    {
        $request = PaymentByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#get-payment-by-key
     * @param string $key
     * @return PaymentByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = PaymentByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#create-a-payment
     * @param PaymentDraft $payment
     * @return PaymentCreateRequest
     */
    public function create(PaymentDraft $payment)
    {
        $request = PaymentCreateRequest::ofDraft($payment);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#delete-payment-by-key
     * @param Payment $payment
     * @return PaymentDeleteByKeyRequest
     */
    public function deleteByKey(Payment $payment)
    {
        $request = PaymentDeleteByKeyRequest::ofKeyAndVersion($payment->getKey(), $payment->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#delete-payment
     * @param Payment $payment
     * @return PaymentDeleteRequest
     */
    public function delete(Payment $payment)
    {
        $request = PaymentDeleteRequest::ofIdAndVersion($payment->getId(), $payment->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#query-payments
     * @param 
     * @return PaymentQueryRequest
     */
    public function query()
    {
        $request = PaymentQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#update-payment-by-key
     * @param Payment $payment
     * @return PaymentUpdateByKeyRequest
     */
    public function updateByKey(Payment $payment)
    {
        $request = PaymentUpdateByKeyRequest::ofKeyAndVersion($payment->getKey(), $payment->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#update-payment
     * @param Payment $payment
     * @return PaymentUpdateRequest
     */
    public function update(Payment $payment)
    {
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion());
        return $request;
    }

    /**
     * @return PaymentRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
