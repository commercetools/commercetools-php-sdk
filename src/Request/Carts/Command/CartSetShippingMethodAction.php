<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\ShippingMethod\ShippingMethodReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartSetShippingMethodAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartSetShippingMethodAction setAction(string $action)
 * @method ShippingMethodReference getShippingMethod()
 * @method CartSetShippingMethodAction setShippingMethod(ShippingMethodReference $shippingMethod)
 */
class CartSetShippingMethodAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shippingMethod' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingMethodReference'],
        ];
    }

    /**
     * @param $code
     */
    public function __construct()
    {
        $this->setAction('setShippingMethod');
    }
}
