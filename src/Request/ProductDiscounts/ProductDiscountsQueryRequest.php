<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class ProductDiscountsQueryRequest
 * @package Sphere\Core\Request\ProductDiscounts
 * @link http://dev.sphere.io/http-api-projects-productDiscounts.html#product-discounts-by-query
 */
class ProductDiscountsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\Collection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $context);
    }
}
