<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#change-order-state
 * @method string getAction()
 * @method OrderChangeOrderStateAction setAction(string $action = null)
 * @method string getOrderState()
 * @method OrderChangeOrderStateAction setOrderState(string $orderState = null)
 */
class OrderChangeOrderStateAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeOrderState');
    }

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'orderState' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param $orderState
     * @param Context|callable $context
     * @return OrderChangeOrderStateAction
     */
    public static function ofOrderState($orderState, $context = null)
    {
        return static::of($context)->setOrderState($orderState);
    }
}
