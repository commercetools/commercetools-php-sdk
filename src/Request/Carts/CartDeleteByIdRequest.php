<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:02
 */

namespace Sphere\Core\Request\Carts;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;
use Sphere\Core\Request\Carts\CartsEndpoint;

/**
 * Class CategoryDeleteByIdRequest
 * @package Sphere\Core\Request\Carts
 * @link http://dev.sphere.io/http-api-projects-carts.html#delete-cart
 * @method static CartDeleteByIdRequest of(string $id, int $version)
 */
class CartDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Cart\Cart';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $id, $version, $context);
    }
}
