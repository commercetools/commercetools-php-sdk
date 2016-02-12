<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 * @link https://dev.commercetools.com/http-api-projects-productDiscounts.html#product-discounts-by-query
 * @method ProductDiscountCollection mapResponse(ApiResponseInterface $response)
 */
class ProductDiscountQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ProductDiscount\ProductDiscountCollection';

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
