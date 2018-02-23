<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Payments
 * @link https://docs.commercetools.com/http-api-projects-payments.html#delete-payment-by-key
 * @method Payment mapResponse(ApiResponseInterface $response)
 * @method Payment mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class PaymentDeleteByKeyRequest extends AbstractDeleteByKeyRequest
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
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
