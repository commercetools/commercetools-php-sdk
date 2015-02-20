<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;


use Sphere\Core\Request\AbstractAction;

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
