<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class CartRemoveCustomLineItemAction
 * @package Sphere\Core\Request\Carts\Command
 * @method string getAction()
 * @method CartRemoveCustomLineItemAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method CartRemoveCustomLineItemAction setCustomLineItemId(string $customLineItemId = null)
 */
class CartRemoveCustomLineItemAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'customLineItemId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $customLineItemId
     */
    public function __construct($customLineItemId)
    {
        $this->setAction('removeCustomLineItem');
        $this->setCustomLineItemId($customLineItemId);
    }
}
