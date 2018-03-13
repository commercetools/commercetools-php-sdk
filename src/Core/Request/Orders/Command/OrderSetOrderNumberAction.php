<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#set-order-number
 * @method string getAction()
 * @method OrderSetOrderNumberAction setAction(string $action = null)
 * @method string getOrderNumber()
 * @method OrderSetOrderNumberAction setOrderNumber(string $orderNumber = null)
 */
class OrderSetOrderNumberAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'orderNumber' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setOrderNumber');
    }
}
