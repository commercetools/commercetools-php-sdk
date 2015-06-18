<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductDiscounts;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class ProductDiscountUpdateRequest
 * @package Sphere\Core\Request\ProductDiscounts
 * @link http://dev.sphere.io/http-api-projects-productDiscounts.html#update-product-discount
 */
class ProductDiscountUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\ProductDiscount\ProductDiscount';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductDiscountsEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
