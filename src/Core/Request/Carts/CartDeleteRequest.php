<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Commercetools\Core\Request\Carts;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Cart\Cart;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Carts
 * @link https://dev.commercetools.com/http-api-projects-carts.html#delete-cart
 * @method Cart mapResponse(ApiResponseInterface $response)
 * @method Cart mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class CartDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = Cart::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
