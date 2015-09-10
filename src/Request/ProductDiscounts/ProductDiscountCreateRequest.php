<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ProductDiscount\ProductDiscountDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\ProductDiscount\ProductDiscount;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ProductDiscounts
 *
 * @method ProductDiscount mapResponse(ApiResponseInterface $response)
 */
class ProductDiscountCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ProductDiscount\ProductDiscount';

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
