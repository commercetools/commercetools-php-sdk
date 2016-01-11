<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 * @apidoc http://dev.sphere.io/http-api-projects-cartDiscounts.html#cart-discount-by-id
 * @method CartDiscount mapResponse(ApiResponseInterface $response)
 */
class CartDiscountByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CartDiscount\CartDiscount';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $id, $context);
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
