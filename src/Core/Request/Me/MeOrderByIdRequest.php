<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-orders.html#get-order-by-id
 * @method Order mapResponse(ApiResponseInterface $response)
 * @method Order mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeOrderByIdRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Order::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(MeOrdersEndpoint::endpoint(), $id, $context);
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
