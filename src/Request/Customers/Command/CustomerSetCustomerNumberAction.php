<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerSetCustomerNumberAction
 * @package Sphere\Core\Request\Customers\Command
 * @method string getCustomerNumber()
 * @method CustomerSetCustomerNumberAction setCustomerNumber(string $customerNumber = null)
 * @method string getAction()
 * @method CustomerSetCustomerNumberAction setAction(string $action = null)
 */
class CustomerSetCustomerNumberAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customerNumber' => [static::TYPE => 'string'],
        ];
    }

    public function __construct()
    {
        $this->setAction('setCustomerNumber');
    }
}
