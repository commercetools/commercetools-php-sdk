<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 * @link https://dev.commercetools.com/http-api-projects-productDiscounts.html#query-productdiscounts
 * @method ProductDiscountCollection mapResponse(ApiResponseInterface $response)
 * @method ProductDiscountCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductDiscountQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = ProductDiscountCollection::class;

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
