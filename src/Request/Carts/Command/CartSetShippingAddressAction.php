<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-shipping-address
 * @method string getAction()
 * @method CartSetShippingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method CartSetShippingAddressAction setAddress(Address $address = null)
 */
class CartSetShippingAddressAction extends AbstractAction
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
        $this->setAction('setShippingAddress');
    }
}
