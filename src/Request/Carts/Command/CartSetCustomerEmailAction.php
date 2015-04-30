<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartSetCustomerEmailAction
 * @package Sphere\Core\Request\Carts\Command
 * @link http://dev.sphere.io/http-api-projects-carts.html#set-customer-email
 * @method string getAction()
 * @method CartSetCustomerEmailAction setAction(string $action = null)
 * @method string getEmail()
 * @method CartSetCustomerEmailAction setEmail(string $email = null)
 */
class CartSetCustomerEmailAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'email' => [static::TYPE => 'string'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setCustomerEmail');
    }
}
