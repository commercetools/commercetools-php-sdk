<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#set-billing-address
 * @method string getAction()
 * @method CartSetBillingAddressAction setAction(string $action = null)
 * @method Address getAddress()
 * @method CartSetBillingAddressAction setAddress(Address $address = null)
 */
class CartSetBillingAddressAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => '\Commercetools\Core\Model\Common\Address'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setBillingAddress');
    }
}
