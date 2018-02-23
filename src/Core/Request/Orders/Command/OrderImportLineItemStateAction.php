<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\ItemStateCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 * @link https://docs.commercetools.com/http-api-projects-orders.html#import-state-for-lineitems
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

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'state' => [static::TYPE => ItemStateCollection::class]
        ];
    }

    /**
     * @param string $lineItemId
     * @param ItemStateCollection $state
     * @param Context|callable $context
     * @return OrderImportLineItemStateAction
     */
    public static function ofLineItemIdAndState($lineItemId, ItemStateCollection $state, $context = null)
    {
        return static::of($context)->setLineItemId($lineItemId)->setState($state);
    }
}
