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

    protected $resultClass = '\Sphere\Core\Model\Cart\CartCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $context);
    }
}
