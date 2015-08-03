<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Model\Cart\CartCollection;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Carts
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#carts-by-query
 * @method CartCollection mapResponse(ApiResponseInterface $response)
 */
class CartQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Cart\CartCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $context);
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
