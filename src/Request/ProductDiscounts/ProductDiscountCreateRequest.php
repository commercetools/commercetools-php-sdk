<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\ProductDiscount\ProductDiscountDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\ProductDiscount\ProductDiscount;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\ProductDiscounts
 * 
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 */
class ProductDiscountCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductDiscount\ProductDiscount';

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
