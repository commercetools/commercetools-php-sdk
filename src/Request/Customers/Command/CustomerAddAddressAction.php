<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\Common\Address;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Customers\Command
 * @link http://dev.sphere.io/http-api-projects-customers.html#add-address
 * @method Address getAddress()
 * @method CustomerAddAddressAction setAddress(Address $address = null)
 * @method string getAction()
 * @method CustomerAddAddressAction setAction(string $action = null)
 */
class CustomerAddAddressAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'address' => [static::TYPE => '\Sphere\Core\Model\Common\Address'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addAddress');
    }

    /**
     * @param Address $address
     * @param Context|callable $context
     * @return CustomerAddAddressAction
     */
    public static function ofAddress(Address $address, $context = null)
    {
        return static::of($context)->setAddress($address);
    }
}
