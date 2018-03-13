<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingmethod
 * @method string getAction()
 * @method CartSetShippingMethodAction setAction(string $action = null)
 * @method ShippingMethodReference getShippingMethod()
 * @method CartSetShippingMethodAction setShippingMethod(ShippingMethodReference $shippingMethod = null)
 */
class CartSetShippingMethodAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shippingMethod' => [static::TYPE => ShippingMethodReference::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setShippingMethod');
    }
}
