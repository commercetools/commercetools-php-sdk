<?php
/**
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 *
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 * @method ProductDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductDiscountUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = ProductDiscount::class;

    /**
     * @param string $key
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
