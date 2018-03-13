<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-value
 * @method string getAction()
 * @method CartDiscountChangeValueAction setAction(string $action = null)
 * @method CartDiscountValue getValue()
 * @method CartDiscountChangeValueAction setValue(CartDiscountValue $value = null)
 */
class CartDiscountChangeValueAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'value' => [static::TYPE => CartDiscountValue::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeValue');
    }

    /**
     * @param CartDiscountValue $cartDiscountValue
     * @param Context|callable $context
     * @return CartDiscountChangeValueAction
     */
    public static function ofCartDiscountValue(CartDiscountValue $cartDiscountValue, $context = null)
    {
        return static::of($context)->setValue($cartDiscountValue);
    }
}
