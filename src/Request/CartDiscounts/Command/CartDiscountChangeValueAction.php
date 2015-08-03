<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @method string getAction()
 * @method CartDiscountChangeValueAction setAction(string $action = null)
 * @method CartDiscountValue getValue()
 * @method CartDiscountChangeValueAction setValue(CartDiscountValue $value = null)
 */
class CartDiscountChangeValueAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'value' => [static::TYPE => '\Commercetools\Core\Model\CartDiscount\CartDiscountValue'],
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
