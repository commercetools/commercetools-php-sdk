<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\Order;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://dev.commercetools.com/http-api-projects-me-orders.html#get-order-by-id
 * @method Order mapResponse(ApiResponseInterface $response)
 */
class MeOrderByIdRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Order\Order';

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
