<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Inventory\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\Common\DateTimeDecorator;

/**
 * Class InventorySetExpectedDeliveryAction
 * @package Sphere\Core\Request\Inventory\Command
 * 
 * @method string getAction()
 * @method InventorySetExpectedDeliveryAction setAction(string $action = null)
 * @method DateTimeDecorator getExpectedDelivery()
 * @method InventorySetExpectedDeliveryAction setExpectedDelivery(\DateTime $expectedDelivery = null)
 */
class InventorySetExpectedDeliveryAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'expectedDelivery' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
            ],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setExpectedDelivery');
    }
}
