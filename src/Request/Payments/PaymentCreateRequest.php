<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Payments
 *
 * @method Payment mapResponse(ApiResponseInterface $response)
 */
class PaymentCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Payment\Payment';

    /**
     * @param PaymentDraft $productDiscount
     * @param Context $context
     */
    public function __construct(PaymentDraft $payment, Context $context = null)
    {
        parent::__construct(PaymentsEndpoint::endpoint(), $payment, $context);
    }

    /**
     * @param PaymentDraft $payment
     * @param Context $context
     * @return static
     */
    public static function ofDraft(PaymentDraft $payment, Context $context = null)
    {
        return new static($payment, $context);
    }
}
