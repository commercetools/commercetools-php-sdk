<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CustomerSetCustomerNumberAction
 * @package Sphere\Core\Request\Customers\Command
 * @link http://dev.sphere.io/http-api-projects-customers.html#set-customer-number
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

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomerNumber');
    }
}
