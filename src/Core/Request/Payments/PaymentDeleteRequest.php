<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Payments
 * @link https://docs.commercetools.com/http-api-projects-payments.html#delete-payment
 * @method Payment mapResponse(ApiResponseInterface $response)
 * @method Payment mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class PaymentDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = Payment::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(PaymentsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
