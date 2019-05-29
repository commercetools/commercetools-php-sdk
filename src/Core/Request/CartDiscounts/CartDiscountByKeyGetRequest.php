<?php
/**
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 *
 * @method CartDiscount mapResponse(ApiResponseInterface $response)
 * @method CartDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CartDiscountByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = CartDiscount::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $key, $context);
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
