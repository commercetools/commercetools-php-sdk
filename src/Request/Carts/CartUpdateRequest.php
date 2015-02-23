<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts;

use Sphere\Core\Model\Common\Context;
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
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(CartsEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
