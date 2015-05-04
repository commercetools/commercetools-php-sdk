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
     * @param string $lineItemId
     * @param ItemStateCollection $state
     * @param Context $context
     */
    public function __construct($lineItemId, ItemStateCollection $state, Context $context = null)
    {
        $this->setContext($context)
            ->setAction('importCustomLineItemState')
            ->setCustomLineItemId($lineItemId)
            ->setState($state);
    }

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Sphere\Core\Model\Order\ItemStateCollection']
        ];
    }
}
