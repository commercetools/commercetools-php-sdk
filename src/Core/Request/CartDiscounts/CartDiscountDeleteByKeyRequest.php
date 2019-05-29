<?php
/**
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 *
 * @method CartDiscount mapResponse(ApiResponseInterface $response)
 * @method CartDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CartDiscountDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = CartDiscount::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $key, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
