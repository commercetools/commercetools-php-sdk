<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Cart\ShippingRateInput;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 * @link https://dev.commercetools.com/http-api-projects-carts.html#set-shippingrateinput
 * @link https://docs.commercetools.com/http-api-projects-carts.html#set-shippingrateinput
 * @method string getAction()
 * @method CartSetShippingRateInputAction setAction(string $action = null)
 * @method ShippingRateInput getShippingRateInput()
 * @method CartSetShippingRateInputAction setShippingRateInput(ShippingRateInput $shippingRateInput = null)
 */
class CartSetShippingRateInputAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shippingRateInput' => [static::TYPE => ShippingRateInput::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setShippingRateInput');
    }
}
