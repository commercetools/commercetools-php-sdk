<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\ItemStateCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link http://dev.commercetools.com/http-api-projects-orders.html#import-custom-line-item-state
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

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\Order\ItemStateCollection']
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
