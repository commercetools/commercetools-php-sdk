<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 * @link https://dev.commercetools.com/http-api-projects-productDiscounts.html#create-a-productdiscount
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 * @method ProductDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductDiscountCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = ProductDiscount::class;

    /**
     * @param ProductDiscountDraft $productDiscount
     * @param Context $context
     */
    public function __construct(ProductDiscountDraft $productDiscount, Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $productDiscount, $context);
    }

    /**
     * @param ProductDiscountDraft $productDiscount
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ProductDiscountDraft $productDiscount, Context $context = null)
    {
        return new static($productDiscount, $context);
    }
}
