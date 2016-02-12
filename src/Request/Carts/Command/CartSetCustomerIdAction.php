<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link http://dev.commercetools.com/http-api-projects-carts.html#set-customer-id
 * @method string getAction()
 * @method CartSetCustomerIdAction setAction(string $action = null)
 * @method string getCustomerId()
 * @method CartSetCustomerIdAction setCustomerId(string $customerId = null)
 */
class CartSetCustomerIdAction extends AbstractAction
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
