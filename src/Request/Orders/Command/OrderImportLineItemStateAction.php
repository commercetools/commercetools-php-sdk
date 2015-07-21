<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Order\ItemStateCollection;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#import-line-item-state
 * @method string getAction()
 * @method OrderImportLineItemStateAction setAction(string $action = null)
 * @method string getLineItemId()
 * @method OrderImportLineItemStateAction setLineItemId(string $lineItemId = null)
 * @method ItemStateCollection getState()
 * @method OrderImportLineItemStateAction setState(ItemStateCollection $state = null)
 */
class OrderImportLineItemStateAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('importLineItemState');
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Sphere\Core\Model\Order\ItemStateCollection']
        ];
    }

    /**
     * @param string $lineItemId
     * @param ItemStateCollection $state
     * @param Context|callable $context
     * @return OrderImportCustomLineItemStateAction
     */
    public static function ofLineItemIdAndState($lineItemId, ItemStateCollection $state, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId)->setState($state);
    }
}
