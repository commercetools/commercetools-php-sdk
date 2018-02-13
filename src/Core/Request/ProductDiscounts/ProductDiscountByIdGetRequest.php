<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#get-productdiscount-by-id
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 * @method ProductDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductDiscountByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = ProductDiscount::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
