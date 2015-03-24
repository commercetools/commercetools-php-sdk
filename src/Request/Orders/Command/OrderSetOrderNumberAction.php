<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderSetOrderNumberAction
 * @package Sphere\Core\Request\Orders\Command
 * @method string getAction()
 * @method OrderSetOrderNumberAction setAction(string $action = null)
 * @method string getOrderNumber()
 * @method OrderSetOrderNumberAction setOrderNumber(string $orderNumber = null)
 */
class OrderSetOrderNumberAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'orderNumber' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        $this->setContext($context)
            ->setAction('setOrderNumber')
        ;
    }
}
