<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-orders.html#query-orders
 * @method OrderCollection mapResponse(ApiResponseInterface $response)
 * @method OrderCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeOrderQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = OrderCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(MeOrdersEndpoint::endpoint(), $context);
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
