<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CartDiscountUpdateRequest
 * @package Sphere\Core\Request\CartDiscounts
 * @link http://dev.sphere.io/http-api-projects-cartDiscounts.html#create-cart-discount
 */
class CartDiscountUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\CartDiscount\CartDiscount';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
