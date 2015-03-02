<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;

use Sphere\Core\Model\Cart\Cart;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class CustomerFetchByIdRequest
 * @package Sphere\Core\Request\Carts
 * @method static CartFetchByIdRequest of(string $id)
 */
class CartFetchByIdRequest extends AbstractFetchByIdRequest
{
    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param array $result
     * @param Context $context
     * @return Cart|null
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result)) {
            return Cart::fromArray($result, $context);
        }
        return null;
    }
}
