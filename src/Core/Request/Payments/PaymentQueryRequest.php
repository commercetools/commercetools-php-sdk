<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Payment\PaymentCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Payments
 * @link https://docs.commercetools.com/http-api-projects-payments.html#query-payments
 * @method PaymentCollection mapResponse(ApiResponseInterface $response)
 * @method PaymentCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class PaymentQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = PaymentCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(PaymentsEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
