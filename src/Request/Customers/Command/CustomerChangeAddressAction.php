<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Address;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 * @apidoc http://dev.sphere.io/http-api-projects-customers.html#change-address
 * @method string getAddressId()
 * @method Address getAddress()
 * @method CustomerChangeAddressAction setAddressId(string $addressId = null)
 * @method CustomerChangeAddressAction setAddress(Address $address = null)
 * @method string getAction()
 * @method CustomerChangeAddressAction setAction(string $action = null)
 */
class CustomerChangeAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'addressId' => [static::TYPE => 'string'],
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
        $this->setAction('changeAddress');
    }

    /**
     * @param string $addressId
     * @param Address $address
     * @param Context|callable $context
     * @return CustomerChangeAddressAction
     */
    public static function ofAddressIdAndAddress($addressId, Address $address, $context = null)
    {
        return static::of($context)->setAddressId($addressId)->setAddress($address);
    }
}
