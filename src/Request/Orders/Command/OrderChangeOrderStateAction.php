<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderChangeOrderStateAction
 * @package Sphere\Core\Request\Orders\Command
 * @method string getAction()
 * @method OrderChangeOrderStateAction setAction(string $action = null)
 * @method string getOrderState()
 * @method OrderChangeOrderStateAction setOrderState(string $orderState = null)
 */
class OrderChangeOrderStateAction extends AbstractAction
{
    /**
     * @param string $orderState
     * @param Context $context
     */
    public function __construct($orderState, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('changeOrderState')
            ->setOrderState($orderState);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'orderState' => [static::TYPE => 'string']
        ];
    }
}
