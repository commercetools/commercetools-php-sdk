<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @link http://dev.commercetools.com/http-api-projects-customers.html#add-billing-address-id
 * @method string getAddressId()
 * @method CustomerRemoveBillingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerRemoveBillingAddressAction setAction(string $action = null)
 */
class CustomerRemoveBillingAddressAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeBillingAddressId');
    }
}
