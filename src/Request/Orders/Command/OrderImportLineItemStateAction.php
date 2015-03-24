<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Orders\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Order\ItemStateCollection;
use Sphere\Core\Request\AbstractAction;

/**
 * Class OrderImportLineItemStateAction
 * @package Sphere\Core\Request\Orders\Command
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
     * @param string $lineItemId
     * @param ItemStateCollection $state
     * @param Context $context
     */
    public function __construct($lineItemId, ItemStateCollection $state, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('importLineItemState')
            ->setLineItemId($lineItemId)
            ->setState($state);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'lineItemId' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Sphere\Core\Model\Order\ItemStateCollection']
        ];
    }
}
