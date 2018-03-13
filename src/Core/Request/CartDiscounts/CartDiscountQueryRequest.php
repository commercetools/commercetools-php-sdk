<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscountCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#query-cartdiscounts
 * @method CartDiscountCollection mapResponse(ApiResponseInterface $response)
 * @method CartDiscountCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CartDiscountQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = CartDiscountCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $context);
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
