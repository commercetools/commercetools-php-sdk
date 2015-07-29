<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Orders\Command
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#set-order-number
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setOrderNumber');
    }
}
