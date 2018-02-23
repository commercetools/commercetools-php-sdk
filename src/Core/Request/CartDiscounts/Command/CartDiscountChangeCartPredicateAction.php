<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#change-cart-predicate
 * @method string getAction()
 * @method CartDiscountChangeCartPredicateAction setAction(string $action = null)
 * @method string getCartPredicate()
 * @method CartDiscountChangeCartPredicateAction setCartPredicate(string $cartPredicate = null)
 */
class CartDiscountChangeCartPredicateAction extends AbstractAction
{
    public function fieldDefinitions()
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
