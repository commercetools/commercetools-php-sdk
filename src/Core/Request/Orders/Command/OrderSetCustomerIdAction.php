<?php
/**
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-customer-id
 * @method string getAction()
 * @method OrderSetCustomerIdAction setAction(string $action = null)
 * @method string getCustomerId()
 * @method OrderSetCustomerIdAction setCustomerId(string $customerId = null)
 */
class OrderSetCustomerIdAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customerId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomerId');
    }
}
