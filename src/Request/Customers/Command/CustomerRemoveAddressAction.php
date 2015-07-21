<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Customers\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Customers\Command
 * @link http://dev.sphere.io/http-api-projects-customers.html#remove-address
 * @method string getAddressId()
 * @method CustomerRemoveAddressAction setAddressId(string $addressId = null)
 * @method string getAction()
 * @method CustomerRemoveAddressAction setAction(string $action = null)
 */
class CustomerRemoveAddressAction extends AbstractAction
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
        $this->setAction('removeAddress');
    }

    /**
     * @param $addressId
     * @param Context|callable $context
     * @return CustomerRemoveAddressAction
     */
    public static function ofAddressId($addressId, $context = null)
    {
        return static::of($context)->setAddressId($addressId);
    }
}
