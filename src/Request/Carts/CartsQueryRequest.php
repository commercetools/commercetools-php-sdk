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
 * @link http://dev.sphere.io/http-api-projects-carts.html#carts-by-query
 */
class CartsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Cart\CartCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
