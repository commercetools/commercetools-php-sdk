<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class ProductDiscountFetchByIdRequest
 * @package Sphere\Core\Request\ProductDiscounts
 * @link http://dev.sphere.io/http-api-projects-productDiscounts.html#product-discount-by-id
 */
class ProductDiscountFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $id, $context);
    }
}
