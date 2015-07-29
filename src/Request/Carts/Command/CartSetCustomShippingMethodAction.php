<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Carts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;
use Sphere\Core\Model\ShippingMethod\ShippingRate;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * @package Sphere\Core\Request\Carts\Command
 * @apidoc http://dev.sphere.io/http-api-projects-carts.html#set-custom-shipping-method
 * @method string getAction()
 * @method CartSetCustomShippingMethodAction setAction(string $action = null)
 * @method string getShippingMethodName()
 * @method CartSetCustomShippingMethodAction setShippingMethodName(string $shippingMethodName = null)
 * @method ShippingRate getShippingRate()
 * @method CartSetCustomShippingMethodAction setShippingRate(ShippingRate $shippingRate = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method CartSetCustomShippingMethodAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 */
class CartSetCustomShippingMethodAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shippingMethodName' => [static::TYPE => 'string'],
            'shippingRate' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ShippingRate'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomShippingMethod');
    }
}
