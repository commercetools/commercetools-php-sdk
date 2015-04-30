<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartSetCustomerIdAction
 * @package Sphere\Core\Request\Carts\Command
 * @link http://dev.sphere.io/http-api-projects-carts.html#set-customer-id
 * @method string getAction()
 * @method CartSetCustomerIdAction setAction(string $action = null)
 * @method string getCustomerId()
 * @method CartSetCustomerIdAction setCustomerId(string $customerId = null)
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
