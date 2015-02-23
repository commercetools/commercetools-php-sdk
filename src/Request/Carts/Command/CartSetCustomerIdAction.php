<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartSetCustomerIdAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartSetCustomerIdAction setAction(string $action)
 * @method string getCustomerId()
 * @method CartSetCustomerIdAction setCustomerId(string $customerId)
 */
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
