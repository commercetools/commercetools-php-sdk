<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\DiscountCodes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\DiscountCodes\Command
 * 
 * @method string getAction()
 * @method DiscountCodeSetCartPredicateAction setAction(string $action = null)
 * @method string getCartPredicate()
 * @method DiscountCodeSetCartPredicateAction setCartPredicate(string $cartPredicate = null)
 */
class DiscountCodeSetCartPredicateAction extends AbstractAction
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
        $this->setAction('setCartPredicate');
    }
}
