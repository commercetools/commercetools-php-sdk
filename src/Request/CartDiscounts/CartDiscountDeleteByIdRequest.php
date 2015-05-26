<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class CartDiscountDeleteByIdRequest
 * @package Sphere\Core\Request\CartDiscounts
 * @link http://dev.sphere.io/http-api-projects-cartDiscounts.html#delete-cart-discount
 */
class CartDiscountDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\CartDiscount\CartDiscount';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $id, $version, $context);
    }
}
