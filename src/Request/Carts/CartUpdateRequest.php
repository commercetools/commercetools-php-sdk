<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;

use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CartUpdateRequest
 * @package Sphere\Core\Request\Carts
 * @method static CartUpdateRequest of(string $id, int $version, array $actions = [])
 */
class CartUpdateRequest extends AbstractUpdateRequest
{
    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     */
    public function __construct($id, $version, array $actions = [])
    {
        parent::__construct(CartsEndpoint::endpoint(), $id, $version, $actions);
    }
}
