<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Model\ProductDiscount\ProductDiscountCollection;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\ProductDiscounts
 * @link http://dev.sphere.io/http-api-projects-productDiscounts.html#product-discounts-by-query
 * @method ProductDiscountCollection mapResponse(ApiResponseInterface $response)
 */
class ProductDiscountQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductDiscount\ProductDiscountCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $context);
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
