<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CartDiscounts\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CartDiscountChangeCartPredicateAction
 * @package Sphere\Core\Request\CartDiscounts\Command
 * @method string getAction()
 * @method CartDiscountChangeCartPredicateAction setAction(string $action = null)
 * @method string getCartPredicate()
 * @method CartDiscountChangeCartPredicateAction setCartPredicate(string $cartPredicate = null)
 */
class CartDiscountChangeCartPredicateAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'cartPredicate' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeCartPredicate');
    }

    /**
     * @param $cartPredicate
     * @param Context|callable $context
     * @return CartDiscountChangeCartPredicateAction
     */
    public static function ofCartPredicate($cartPredicate, $context = null)
    {
        return static::of($context)->setCartPredicate($cartPredicate);
    }
}
