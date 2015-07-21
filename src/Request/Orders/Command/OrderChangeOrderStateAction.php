<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#change-order-state
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

    public function getFields()
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
