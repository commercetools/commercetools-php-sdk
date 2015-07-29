<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Customers\Command
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#set-default-billing-address
 * @method string getAddressId()
 * @method CustomerSetDefaultBillingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerSetDefaultBillingAddressAction setAction(string $action = null)
 */
class CustomerSetDefaultBillingAddressAction extends AbstractAction
{
    public function getFields()
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
