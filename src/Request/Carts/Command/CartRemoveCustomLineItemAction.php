<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#remove-custom-line-item
 * @method string getAction()
 * @method CartRemoveCustomLineItemAction setAction(string $action = null)
 * @method string getCustomLineItemId()
 * @method CartRemoveCustomLineItemAction setCustomLineItemId(string $customLineItemId = null)
 */
class CartRemoveCustomLineItemAction extends AbstractAction
{
    public function getPropertyDefinitions()
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
