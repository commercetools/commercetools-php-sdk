<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Cart\CartCollection;
use Commercetools\Core\Request\InStores\InStoreRequestDecorator;
use Commercetools\Core\Request\InStores\InStoreTrait;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://docs.commercetools.com/http-api-projects-me-carts.html#query-carts
 * @method CartCollection mapResponse(ApiResponseInterface $response)
 * @method CartCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 * @method MeCartQueryRequest|InStoreRequestDecorator inStore($storeKey)
 */
class MeCartQueryRequest extends AbstractQueryRequest
{
    use InStoreTrait;

    protected $resultClass = CartCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(MeCartsEndpoint::endpoint(), $context);
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
