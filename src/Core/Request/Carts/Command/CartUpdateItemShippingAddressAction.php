<?php
/**
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartUpdateItemShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method CartUpdateItemShippingAddressAction setAddress(Address $address = null)
 */
class CartUpdateItemShippingAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => Address::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('updateItemShippingAddress');
    }
}
