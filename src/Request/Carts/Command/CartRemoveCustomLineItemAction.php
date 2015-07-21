<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Carts\Command
 * @link http://dev.sphere.io/http-api-projects-carts.html#remove-custom-line-item
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeCustomLineItem');
    }

    /**
     * @param $customLineItemId
     * @param Context|callable $context
     * @return CartRemoveCustomLineItemAction
     */
    public static function ofCustomLineItemId($customLineItemId, $context = null)
    {
        return static::of($context)->setCustomLineItemId($customLineItemId);
    }
}
