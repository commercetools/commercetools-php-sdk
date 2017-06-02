<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Payments
 * @link https://dev.commercetools.com/http-api-projects-payments.html#get-payment-by-id
 * @method Payment mapResponse(ApiResponseInterface $response)
 * @method Payment mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class PaymentByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Payment::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(PaymentsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
