<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://dev.commercetools.com/http-api-projects-customers.html#set-customergroup
 * @method CustomerGroupReference getCustomerGroup()
 * @method CustomerSetCustomerGroupAction setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method string getAction()
 * @method CustomerSetCustomerGroupAction setAction(string $action = null)
 */
class CustomerSetCustomerGroupAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customerGroup' => [static::TYPE => '\Commercetools\Core\Model\CustomerGroup\CustomerGroupReference'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomerGroup');
    }
}
