<?php
/**
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 *
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 * @method ProductDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductDiscountByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = ProductDiscount::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
