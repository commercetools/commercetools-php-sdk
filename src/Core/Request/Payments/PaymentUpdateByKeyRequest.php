<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Payments
 * @link https://docs.commercetools.com/http-api-projects-payments.html#update-payment-by-key
 * @method Payment mapResponse(ApiResponseInterface $response)
 * @method Payment mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class PaymentUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = Payment::class;

    /**
     * @param string $key
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(PaymentsEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
