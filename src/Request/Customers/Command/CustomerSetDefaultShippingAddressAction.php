<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Customers\Command
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#set-default-shipping-address
 * @method string getAddressId()
 * @method CustomerSetDefaultShippingAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerSetDefaultShippingAddressAction setAction(string $action = null)
 */
class CustomerSetDefaultShippingAddressAction extends AbstractAction
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
        $this->setAction('setDefaultShippingAddress');
    }
}
