<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\OrderCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Me
 *
 * @method OrderCollection mapResponse(ApiResponseInterface $response)
 */
class MeOrderQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Order\OrderCollection';

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
