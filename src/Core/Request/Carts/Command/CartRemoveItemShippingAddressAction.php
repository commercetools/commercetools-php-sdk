<?php
/**
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#remove-itemshippingaddress
 * @method string getAction()
 * @method CartRemoveItemShippingAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method CartRemoveItemShippingAddressAction setAddressKey(string $addressKey = null)
 */
class CartRemoveItemShippingAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressKey' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeItemShippingAddress');
    }
}
