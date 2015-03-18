<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\Model\Cart\CartCollection;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Request\CustomerIdTrait;

/**
 * Class CustomersQueryRequest
 * @package Sphere\Core\Request\Carts
 * @method static CartsQueryRequest of()
 */
class CartsQueryRequest extends AbstractQueryRequest
{
    use CustomerIdTrait;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $context);
    }

    /**
     * @param array $result
     * @param Context $context
     * @return CartCollection
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result['results'])) {
            return CartCollection::fromArray($result['results'], $context);
        }

        return new CartCollection([], $context);
    }
}
