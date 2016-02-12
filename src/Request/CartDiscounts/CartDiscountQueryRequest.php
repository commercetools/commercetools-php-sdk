<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscountCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 * @link https://dev.commercetools.com/http-api-projects-cartDiscounts.html#cart-discounts-by-query
 * @method CartDiscountCollection mapResponse(ApiResponseInterface $response)
 */
class CartDiscountQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CartDiscount\CartDiscountCollection';

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
