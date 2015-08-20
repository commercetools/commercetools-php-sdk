<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#set-default-billing-address
 * @method string getAddressId()
 * @method CustomerSetDefaultBillingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerSetDefaultBillingAddressAction setAction(string $action = null)
 */
class CustomerSetDefaultBillingAddressAction extends AbstractAction
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
        $this->setAction('setDefaultBillingAddress');
    }
}
