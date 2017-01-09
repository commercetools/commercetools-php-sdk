<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Inventory\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Request\Inventory\Command
 * @link https://dev.commercetools.com/http-api-projects-inventory.html#set-expecteddelivery
 * @method string getAction()
 * @method InventorySetExpectedDeliveryAction setAction(string $action = null)
 * @method DateTimeDecorator getExpectedDelivery()
 * @method InventorySetExpectedDeliveryAction setExpectedDelivery(\DateTime $expectedDelivery = null)
 */
class InventorySetExpectedDeliveryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'expectedDelivery' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => DateTimeDecorator::class
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
