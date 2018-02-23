<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\CartDiscounts
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#update-cartdiscount
 * @method CartDiscount mapResponse(ApiResponseInterface $response)
 * @method CartDiscount mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CartDiscountUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = CartDiscount::class;

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CartDiscountsEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
