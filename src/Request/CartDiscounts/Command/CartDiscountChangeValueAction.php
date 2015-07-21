<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts\Command;

use Sphere\Core\Model\CartDiscount\CartDiscountValue;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\CartDiscounts\Command
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
            'value' => [static::TYPE => '\Sphere\Core\Model\CartDiscount\CartDiscountValue'],
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
