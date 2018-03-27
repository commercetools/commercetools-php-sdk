<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Request\Payments\PaymentByIdGetRequest;
use Commercetools\Core\Request\Payments\PaymentByKeyGetRequest;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentQueryRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateRequest;

class PaymentRequestBuilder
{
    /**
     * @return PaymentQueryRequest
     */
    public function query()
    {
        return PaymentQueryRequest::of();
    }

    /**
     * @param Payment $payment
     * @return PaymentUpdateRequest
     */
    public function update(Payment $payment)
    {
        return PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion());
    }

    /**
     * @param PaymentDraft $paymentDraft
     * @return PaymentCreateRequest
     */
    public function create(PaymentDraft $paymentDraft)
    {
        return PaymentCreateRequest::ofDraft($paymentDraft);
    }

    /**
     * @param Payment $payment
     * @return PaymentDeleteRequest
     */
    public function delete(Payment $payment)
    {
        return PaymentDeleteRequest::ofIdAndVersion($payment->getId(), $payment->getVersion());
    }

    /**
     * @param $id
     * @return PaymentByIdGetRequest
     */
    public function getById($id)
    {
        return PaymentByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return PaymentByKeyGetRequest
     */
    public function getByKey($key)
    {
        return PaymentByKeyGetRequest::ofKey($key);
    }
}
