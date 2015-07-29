<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\CartDiscount\CartDiscountCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\CartDiscounts
 * @apidoc http://dev.sphere.io/http-api-projects-cartDiscounts.html#cart-discounts-by-query
 * @method CartDiscountCollection mapResponse(ApiResponseInterface $response)
 */
class CartDiscountQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\CartDiscount\CartDiscountCollection';

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
