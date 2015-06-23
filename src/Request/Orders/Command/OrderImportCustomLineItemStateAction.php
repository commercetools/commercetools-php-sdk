<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Order\ItemStateCollection;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderImportCustomLineItemStateAction
 * @package Sphere\Core\Request\Orders\Command
 * @link http://dev.sphere.io/http-api-projects-orders.html#import-custom-line-item-state
 * @method string getAction()
 * @method OrderImportCustomLineItemStateAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method OrderImportCustomLineItemStateAction setCustomLineItemId(string $customLineItemId = null)
 * @method ItemStateCollection getState()
 * @method OrderImportCustomLineItemStateAction setState(ItemStateCollection $state = null)
 */
class OrderImportCustomLineItemStateAction extends AbstractAction
{
    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('importCustomLineItemState');
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Sphere\Core\Model\Order\ItemStateCollection']
        ];
    }

    /**
     * @param string $customLineItemId
     * @param ItemStateCollection $state
     * @param Context|callable $context
     * @return OrderImportCustomLineItemStateAction
     */
    public static function ofCustomLineItemIdAndState($customLineItemId, ItemStateCollection $state, $context = null)
    {
        return static::of($context)->setCustomLineItemId($customLineItemId)->setState($state);
    }
}
