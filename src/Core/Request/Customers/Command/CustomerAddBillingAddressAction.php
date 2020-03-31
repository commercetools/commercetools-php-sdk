<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link https://docs.commercetools.com/http-api-projects-customers.html#add-billing-address-id
 * @method string getAddressId()
 * @method CustomerAddBillingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerAddBillingAddressAction setAction(string $action = null)
 * @method string getAddressKey()
 * @method CustomerAddBillingAddressAction setAddressKey(string $addressKey = null)
 */
class CustomerAddBillingAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string'],
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
        $this->setAction('addBillingAddressId');
    }
}
