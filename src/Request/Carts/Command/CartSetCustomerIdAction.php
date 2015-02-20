<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;


use Sphere\Core\Request\AbstractAction;

class CartSetCustomerIdAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setCustomerId');
    }
}
